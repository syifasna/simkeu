<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Pembayaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class AdminController extends Controller
{
    public function dashboard()
    {
        // SPP
        $totalTagihanSPP = Billing::sum('jumlah_tagihan');

        $totalPembayaranSPP = Pembayaran::sum('jumlah_bayar');

        // Keuangan umum
        $totalPemasukan = Pemasukan::sum('jumlah');

        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // Saldo sekolah
        $saldo =
            $totalPembayaranSPP +
            $totalPemasukan -
            $totalPengeluaran;

        $jumlahLunas = Billing::where('status', 'lunas')->count();

        $jumlahBelumLunas = Billing::where('status', '!=', 'lunas')->count();

        $billingTerbaru = Billing::with('siswa')
            ->latest()
            ->take(5)
            ->get();

        $totalTunggakanSPP = Billing::sum('sisa_tagihan');

        $jumlahSiswaMenunggak = Billing::where('status', '!=', 'lunas')
            ->distinct('siswa_id')
            ->count('siswa_id');

        $pembayaranBulanIni = Pembayaran::whereMonth('tanggal_bayar',now()->month)
            ->sum('jumlah_bayar');

        $pengeluaranBulanIni = Pengeluaran::whereMonth( 'tanggal',now()->month)
            ->sum('jumlah');

        $persentasePembayaran = $totalTagihanSPP > 0 ? ($totalPembayaranSPP / $totalTagihanSPP) * 100 : 0;

        return view('admin.dashboard', compact(
            'totalTagihanSPP',
            'totalPembayaranSPP',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'jumlahLunas',
            'jumlahBelumLunas',
            'billingTerbaru', 
            'totalTunggakanSPP',
            'jumlahSiswaMenunggak',
            'pembayaranBulanIni',
            'pengeluaranBulanIni',
            'persentasePembayaran'
        ));
    }
}
