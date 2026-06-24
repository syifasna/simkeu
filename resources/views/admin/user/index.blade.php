<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">Data User</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola akun pengguna sistem.</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="p-6 flex justify-between items-center border-b border-[#F5E7B2]">
                <div>
                    <h3 class="text-xl font-bold text-[#111827]">Daftar User</h3>
                    <p class="text-sm text-slate-500">Data akun admin, staff, dan user.</p>
                </div>

                <a href="{{ route('admin.user.create') }}"
                    class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 text-[#111827] font-bold shadow hover:opacity-90">
                    + Tambah User
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-left">Role</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-[#F8F6F0]">
                                <td class="px-6 py-4">{{ ++$i }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full bg-[#F5E7B2] text-[#7A5C1E] font-semibold">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="rounded-xl bg-yellow-50 px-4 py-2 text-yellow-700 font-semibold hover:bg-yellow-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-xl bg-red-50 px-4 py-2 text-red-700 font-semibold hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
