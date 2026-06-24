<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Services\WhatsAppService;

class PembayaranController extends Controller
{
    public function store(Request $request, Billing $billing)
    {
        $request->validate([
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:1',
            'metode_bayar' => 'required|in:tunai,transfer,payment_gateway',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $billing) {

            Pembayaran::create([
                'billing_id' => $billing->id,
                'siswa_id' => $billing->siswa_id,
                'tanggal_bayar' => $request->tanggal_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'metode_bayar' => $request->metode_bayar,
                'keterangan' => $request->keterangan,
            ]);

            $totalDibayar = $billing->jumlah_dibayar + $request->jumlah_bayar;
            $sisaTagihan = $billing->jumlah_tagihan - $totalDibayar;

            if ($sisaTagihan <= 0) {
                $status = 'lunas';
                $sisaTagihan = 0;
            } elseif ($totalDibayar > 0) {
                $status = 'sebagian';
            } else {
                $status = 'belum_lunas';
            }

            $billing->update([
                'jumlah_dibayar' => $totalDibayar,
                'sisa_tagihan' => $sisaTagihan,
                'status' => $status,
            ]);

            $billing->refresh();

            WhatsAppService::sendBuktiPembayaran($billing);
        });

        return redirect()
            ->route('admin.billing.index')
            ->with('success', 'Pembayaran berhasil disimpan.');
    }

    private function midtransConfig(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function payOnline(Billing $billing)
    {
        $this->midtransConfig();

        $orderId = 'SPP-' . $billing->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $billing->sisa_tagihan,
            ],
            'customer_details' => [
                'first_name' => $billing->siswa->nama_siswa,
                'email' => $billing->siswa->user->email ?? 'siswa@assulthon.com',
                'phone' => $billing->siswa->no_hp_wali ?? $billing->siswa->no_hp ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'SPP-' . $billing->id,
                    'price' => (int) $billing->sisa_tagihan,
                    'quantity' => 1,
                    'name' => 'SPP ' . $billing->bulan . ' ' . $billing->tahun,
                ]
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $redirectRoute = route('admin.billing.index');

        $billing->update([
            'midtrans_order_id' => $orderId,
            'snap_token' => $snapToken,
        ]);

        return view('billing.pay', compact(
            'billing',
            'snapToken',
            'redirectRoute'
        ));
    }

    public function notification(Request $request)
    {
        Log::info('MIDTRANS CALLBACK MASUK');
        Log::info($request->all());

        $this->midtransConfig();

        $notif = new Notification();

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $fraudStatus = $notif->fraud_status ?? null;
        $grossAmount = (float) $notif->gross_amount;

        Log::info('MIDTRANS DATA', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'fraud_status' => $fraudStatus,
            'gross_amount' => $grossAmount,
        ]);

        $billing = Billing::where('midtrans_order_id', $orderId)->first();

        if (!$billing) {
            Log::error('Billing tidak ditemukan untuk order_id: ' . $orderId);

            return response()->json(['message' => 'Billing tidak ditemukan'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $this->savePayment($billing, $grossAmount, 'payment_gateway', 'Pembayaran Midtrans');
            }
        } elseif ($transactionStatus == 'settlement') {
            $this->savePayment($billing, $grossAmount, 'payment_gateway', 'Pembayaran Midtrans');
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $billing->update([
                'midtrans_status' => $transactionStatus,
            ]);
        } elseif ($transactionStatus == 'pending') {
            $billing->update([
                'midtrans_status' => 'pending',
            ]);
        }

        return response()->json(['message' => 'Notification processed']);
    }

    private function savePayment(Billing $billing, float $amount, string $method, string $note): void
    {
        DB::transaction(function () use ($billing, $amount, $method, $note) {

            $alreadyPaid = Pembayaran::where('billing_id', $billing->id)
                ->where('metode_bayar', 'payment_gateway')
                ->exists();

            if ($alreadyPaid && $billing->status == 'lunas') {
                return;
            }

            Pembayaran::create([
                'billing_id' => $billing->id,
                'siswa_id' => $billing->siswa_id,
                'tanggal_bayar' => now()->toDateString(),
                'jumlah_bayar' => $amount,
                'metode_bayar' => $method,
                'keterangan' => $note,
            ]);

            $totalDibayar = $billing->jumlah_dibayar + $amount;
            $sisaTagihan = $billing->jumlah_tagihan - $totalDibayar;

            if ($sisaTagihan <= 0) {
                $status = 'lunas';
                $sisaTagihan = 0;
            } elseif ($totalDibayar > 0) {
                $status = 'sebagian';
            } else {
                $status = 'belum_lunas';
            }

            $billing->update([
                'jumlah_dibayar' => $totalDibayar,
                'sisa_tagihan' => $sisaTagihan,
                'status' => $status,
                'midtrans_status' => 'settlement',
            ]);

            $billing->refresh();

            WhatsAppService::sendBuktiPembayaran($billing);
        });
    }
}
