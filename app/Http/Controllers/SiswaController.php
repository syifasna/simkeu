<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\SiswaStoreRequest;
use App\Http\Requests\SiswaUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $siswas = Siswa::with(['kategori', 'kelas', 'user'])
            ->latest()
            ->paginate(5);

        return view('admin.siswa.index', compact('siswas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoris = Kategori::latest()->get();
        $kelas = Kelas::latest()->get();

        return view('admin.siswa.create', compact('kategoris', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaStoreRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $email = strtolower($data['nis']) . '@assulthon.com';

            $user = User::create([
                'name' => $data['nama_siswa'],
                'email' => $email,
                'password' => Hash::make($data['nis']),
                'role' => 'user',
            ]);

            $data['user_id'] = $user->id;

            Siswa::create($data);
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Siswa dan akun user berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa): View
    {
        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa): View
    {
        $kategoris = Kategori::latest()->get();
        $kelas = Kelas::latest()->get();

        return view('admin.siswa.edit', compact('siswa', 'kategoris', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaUpdateRequest $request, Siswa $siswa): RedirectResponse
    {
        DB::transaction(function () use ($request, $siswa) {
            $data = $request->validated();

            $siswa->update($data);

            if ($siswa->user) {
                $siswa->user->update([
                    'name' => $data['nama_siswa'],
                ]);
            }
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa): RedirectResponse
    {
        DB::transaction(function () use ($siswa) {
            if ($siswa->user) {
                $siswa->user->delete();
            }

            $siswa->delete();
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Siswa dan akun user berhasil dihapus.');
    }
}
