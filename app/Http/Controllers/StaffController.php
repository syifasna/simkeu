<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = User::where('role', 'staff')
            ->latest()
            ->paginate(10);

        return view('admin.staff.index', compact('staffs'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.staff.create');
    }


    public function store(StaffStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff berhasil ditambahkan.');
    }

    public function update(StaffUpdateRequest $request, User $staff)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $staff->update($data);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff berhasil diperbarui.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff berhasil dihapus.');
    }
}
