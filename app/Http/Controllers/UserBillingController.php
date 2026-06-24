<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class UserBillingController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $siswa = $user->siswa;

        $tagihan = Billing::where('siswa_id', $siswa->id);

        $totalTagihan = $tagihan->sum('jumlah_tagihan');

        $totalDibayar = $tagihan->sum('jumlah_dibayar');

        $totalTunggakan = $tagihan->sum('sisa_tagihan');

        $jumlahBelumLunas = Billing::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'lunas')
            ->count();

        $tunggakan = Billing::where('siswa_id', $siswa->id)
            ->where('status', '!=', 'lunas')
            ->latest()
            ->get();

        $histories = Pembayaran::where('siswa_id', $siswa->id)
            ->latest()
            ->take(10)
            ->get();

        return view('user.billing.dashboard', compact(
            'siswa',
            'totalTagihan',
            'totalDibayar',
            'totalTunggakan',
            'jumlahBelumLunas',
            'tunggakan',
            'histories'
        ));
    }

    public function tagihan()
    {
        $siswa = Auth::user()->siswa;

        $billings = Billing::with('kelas')
            ->where('siswa_id', $siswa->id)
            ->where('sisa_tagihan', '>', 0)
            ->latest()
            ->paginate(10);

        return view('user.billing.index', compact('billings'));
    }

    public function riwayat()
    {
        $siswa = Auth::user()->siswa;

        $pembayarans = Pembayaran::with('billing')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->paginate(10);

        return view('user.billing.riwayat', compact('pembayarans'));
    }

    private function midtransConfig(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function bayar(Billing $billing)
    {
        abort_if($billing->siswa_id != Auth::user()->siswa->id, 403);

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
        ];

        $snapToken = Snap::getSnapToken($params);

        $billing->update([
            'midtrans_order_id' => $orderId,
            'snap_token' => $snapToken,
        ]);

        $redirectRoute = route('user.pembayaran');

        return view('billing.pay', compact(
            'billing',
            'snapToken',
            'redirectRoute'
        ));
    }
}
