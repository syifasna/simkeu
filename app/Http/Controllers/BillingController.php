<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WhatsAppService;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $query = Billing::with(['siswa', 'kelas']);

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('search')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $summaryQuery = clone $query;

        $totalTagihan = (clone $summaryQuery)->sum('jumlah_tagihan');
        $totalDibayar = (clone $summaryQuery)->sum('jumlah_dibayar');
        $totalTunggakan = (clone $summaryQuery)->sum('sisa_tagihan');
        $siswaMenunggak = (clone $summaryQuery)
            ->where('status', '!=', 'lunas')
            ->distinct('siswa_id')
            ->count('siswa_id');

        $billings = $query
            ->with(['pembayarans' => function ($q) {
                $q->latest('tanggal_bayar');
            }])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.billing.index', compact(
            'billings',
            'totalTagihan',
            'totalDibayar',
            'totalTunggakan',
            'siswaMenunggak'
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.billing.create');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
            'tahun' => 'required|string',
        ]);

        $siswas = Siswa::with(['kategori', 'kelas', 'user'])
            ->where('status_aktif', 1)
            ->get();

        DB::transaction(function () use ($siswas, $request) {
            foreach ($siswas as $siswa) {

                $cek = Billing::where('siswa_id', $siswa->id)
                    ->where('bulan', $request->bulan)
                    ->where('tahun', $request->tahun)
                    ->exists();

                if ($cek) {
                    continue;
                }

                $biayaDasar = $siswa->kategori->biaya_dasar ?? 0;
                $potongan = $siswa->kategori->persentase_potongan ?? 0;

                $jumlahPotongan = ($biayaDasar * $potongan) / 100;
                $jumlahTagihan = $biayaDasar - $jumlahPotongan;

                $billing = Billing::create([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $siswa->kelas_id,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'jumlah_tagihan' => $jumlahTagihan,
                    'jumlah_dibayar' => 0,
                    'sisa_tagihan' => $jumlahTagihan,
                    'status' => 'belum_lunas',
                ]);

                $billing->load(['siswa', 'kelas']);

                WhatsAppService::sendTagihan($billing);
            }
        });

        return redirect()
            ->route('admin.billing.index')
            ->with('success', 'Tagihan SPP berhasil digenerate.');
    }
}
