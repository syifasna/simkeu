<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{

    public function pemasukan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Pemasukan::query();

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $pemasukans = $query
            ->latest('tanggal')
            ->paginate(10);

        $total = $query->sum('jumlah');

        return view(
            'admin.laporan.pemasukan',
            compact(
                'pemasukans',
                'total',
                'bulan',
                'tahun'
            )
        );
    }

    public function pemasukanPdf(Request $request)
    {
        $query = Pemasukan::query();

        if ($request->bulan) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $data = $query->latest('tanggal')->get();

        $total = $data->sum('jumlah');

        $pdf = Pdf::loadView(
            'admin.laporan.pdfPemasukan',
            [
                'data' => $data,
                'total' => $total,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun
            ]
        );

        return $pdf->download('laporan-pemasukan.pdf');
    }

    public function pengeluaran(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Pengeluaran::query();

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $pengeluarans = $query
            ->latest('tanggal')
            ->paginate(10);

        $total = $query->sum('jumlah');

        return view(
            'admin.laporan.pengeluaran',
            compact(
                'pengeluarans',
                'total',
                'bulan',
                'tahun'
            )
        );
    }

    public function pengeluaranPdf(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->bulan) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $data = $query->latest('tanggal')->get();

        $total = $data->sum('jumlah');

        $pdf = Pdf::loadView(
            'admin.laporan.pdfPengeluaran',
            [
                'data' => $data,
                'total' => $total,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun
            ]
        );

        return $pdf->download('laporan-pengeluaran.pdf');
    }

    public function spp(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Pembayaran::with([
            'siswa',
            'billing'
        ]);

        if ($bulan) {
            $query->whereMonth('tanggal_bayar', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal_bayar', $tahun);
        }

        $totalSPP = (clone $query)->sum('jumlah_bayar');

        $pembayarans = $query
            ->latest('tanggal_bayar')
            ->paginate(10);

        return view(
            'admin.laporan.spp',
            compact(
                'pembayarans',
                'totalSPP',
                'bulan',
                'tahun'
            )
        );
    }

    public function sppPdf(Request $request)
    {
        $query = Pembayaran::with([
            'siswa',
            'billing'
        ]);

        if ($request->bulan) {
            $query->whereMonth(
                'tanggal_bayar',
                $request->bulan
            );
        }

        if ($request->tahun) {
            $query->whereYear(
                'tanggal_bayar',
                $request->tahun
            );
        }

        $pembayarans = $query
            ->latest('tanggal_bayar')
            ->get();

        $totalSPP = $pembayarans->sum('jumlah_bayar');

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.spp',
            compact(
                'pembayarans',
                'totalSPP'
            )
        );

        return $pdf->download(
            'laporan-pembayaran-spp.pdf'
        );
    }

    public function arusKas(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $pembayaran = Pembayaran::query();
        $pemasukan = Pemasukan::query();
        $pengeluaran = Pengeluaran::query();

        if ($bulan) {
            $pembayaran->whereMonth('tanggal_bayar', $bulan);

            $pemasukan->whereMonth('tanggal', $bulan);

            $pengeluaran->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $pembayaran->whereYear('tanggal_bayar', $tahun);

            $pemasukan->whereYear('tanggal', $tahun);

            $pengeluaran->whereYear('tanggal', $tahun);
        }

        $totalSPP = $pembayaran->sum(
            'jumlah_bayar'
        );

        $totalPemasukan = $pemasukan->sum(
            'jumlah'
        );

        $totalPengeluaran = $pengeluaran->sum(
            'jumlah'
        );

        $saldo =
            $totalSPP +
            $totalPemasukan -
            $totalPengeluaran;

        return view(
            'admin.laporan.aruskas',
            compact(
                'totalSPP',
                'totalPemasukan',
                'totalPengeluaran',
                'saldo',
                'bulan',
                'tahun'
            )
        );
    }

    public function arusKasPdf(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $pembayaran = Pembayaran::query();
        $pemasukan = Pemasukan::query();
        $pengeluaran = Pengeluaran::query();

        if ($bulan) {
            $pembayaran->whereMonth('tanggal_bayar', $bulan);
            $pemasukan->whereMonth('tanggal', $bulan);
            $pengeluaran->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $pembayaran->whereYear('tanggal_bayar', $tahun);
            $pemasukan->whereYear('tanggal', $tahun);
            $pengeluaran->whereYear('tanggal', $tahun);
        }

        $totalSPP = $pembayaran->sum('jumlah_bayar');
        $totalPemasukan = $pemasukan->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        $saldo =
            $totalSPP +
            $totalPemasukan -
            $totalPengeluaran;

        $pdf = Pdf::loadView(
            'admin.laporan.pdfArusKas',
            compact(
                'bulan',
                'tahun',
                'totalSPP',
                'totalPemasukan',
                'totalPengeluaran',
                'saldo'
            )
        );

        return $pdf->download('laporan-arus-kas.pdf');
    }
}
