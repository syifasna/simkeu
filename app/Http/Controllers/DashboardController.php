<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
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

        return view('dashboard', compact(
            'siswa',
            'totalTagihan',
            'totalDibayar',
            'totalTunggakan',
            'jumlahBelumLunas',
            'tunggakan',
            'histories'
        ));
    }
}
