<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()
            ->paginate(10);

        return view('admin.pengeluaran.index', compact('pengeluarans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable',
        ]);

        Pengeluaran::create($request->all());

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('admin.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'tanggal' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable',
        ]);

        $pengeluaran->update($request->all());

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()
            ->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

}
