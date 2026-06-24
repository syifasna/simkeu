<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">Edit User</h2>
            <p class="text-sm text-slate-500 mt-1">Perbarui akun pengguna.</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">
            <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] px-8 py-6 text-white">
                <h3 class="text-xl font-bold">Form Edit User</h3>
                <p class="text-sm text-[#F5E7B2]">Ubah data akun.</p>
            </div>

            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                @include('admin.user._form', ['user' => $user])

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.user.index') }}"
                        class="rounded-2xl bg-slate-100 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-200">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-8 py-3 font-bold text-[#111827] shadow hover:opacity-90">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
