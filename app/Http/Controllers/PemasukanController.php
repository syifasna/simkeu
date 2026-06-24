<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::latest()
            ->paginate(10);

        return view('admin.pemasukan.index', compact('pemasukans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable',
        ]);

        Pemasukan::create($request->all());

        return redirect()
            ->route('admin.pemasukan.index')
            ->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    public function edit(Pemasukan $pemasukan)
    {
        return view('admin.pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'tanggal' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable',
        ]);

        $pemasukan->update($request->all());

        return redirect()
            ->route('admin.pemasukan.index')
            ->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();

        return redirect()
            ->route('admin.pemasukan.index')
            ->with('success', 'Data pemasukan berhasil dihapus.');
    }
}
