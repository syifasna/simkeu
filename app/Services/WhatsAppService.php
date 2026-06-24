<?php

namespace App\Services;

use App\Models\Billing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private static function formatNomor($nomor): ?string
    {
        if (!$nomor) return null;

        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        }

        return $nomor;
    }

    public static function sendTagihan(Billing $billing): void
    {
        $nomor = self::formatNomor($billing->siswa->no_hp_wali);

        if (!$nomor) return;

        $message = "Assalamu'alaikum Wr. Wb.\n\n"
            . "Yth. Bapak/Ibu Wali dari *{$billing->siswa->nama_siswa}*\n\n"
            . "Berikut informasi tagihan SPP:\n"
            . "Nama: {$billing->siswa->nama_siswa}\n"
            . "Kelas: {$billing->kelas->nama_kelas}\n"
            . "Periode: {$billing->bulan} {$billing->tahun}\n"
            . "Total Tagihan: Rp " . number_format($billing->jumlah_tagihan, 0, ',', '.') . "\n"
            . "Status: Belum Lunas\n\n"
            . "Silakan melakukan pembayaran melalui sistem sekolah.\n\n"
            . "Terima kasih.\n"
            . "SMP IT As-Sulthon";

        self::send($nomor, $message);
    }

    public static function sendBuktiPembayaran(Billing $billing): void
    {
        $nomor = self::formatNomor($billing->siswa->no_hp_wali);

        if (!$nomor) return;

        $message = "Assalamu'alaikum Wr. Wb.\n\n"
            . "Pembayaran SPP telah berhasil diterima.\n\n"
            . "Nama: {$billing->siswa->nama_siswa}\n"
            . "Kelas: {$billing->kelas->nama_kelas}\n"
            . "Periode: {$billing->bulan} {$billing->tahun}\n"
            . "Total Tagihan: Rp " . number_format($billing->jumlah_tagihan, 0, ',', '.') . "\n"
            . "Total Dibayar: Rp " . number_format($billing->jumlah_dibayar, 0, ',', '.') . "\n"
            . "Sisa Tagihan: Rp " . number_format($billing->sisa_tagihan, 0, ',', '.') . "\n"
            . "Status: " . strtoupper(str_replace('_', ' ', $billing->status)) . "\n\n"
            . "Terima kasih.\n"
            . "SMP IT As-Sulthon";

        self::send($nomor, $message);
    }

    private static function send(string $nomor, string $message): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('WHATSAPP_API_KEY'),
            ])->post(env('WHATSAPP_API_URL'), [
                'target' => $nomor,
                'message' => $message,
            ]);

            Log::info('Fonnte Response', [
                'nomor' => $nomor,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal kirim WhatsApp: ' . $e->getMessage());
        }
    }
}
