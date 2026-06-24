<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Edit Data Siswa
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui data siswa SMP IT As-Sulthon.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] px-8 py-6 text-white">
                <h3 class="text-xl font-bold">
                    Form Edit Siswa
                </h3>
                <p class="text-sm text-[#F5E7B2]">
                    Perbarui data siswa.
                </p>
            </div>

            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                @include('admin.siswa._form')

                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('admin.siswa.index') }}"
                        class="rounded-2xl bg-slate-100 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-200 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-8 py-3 font-bold text-[#111827] shadow hover:opacity-90 transition">
                        Update Data
                    </button>

                </div>
            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `
                    <ul style="text-align:left">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#D4AF37'
            });
        </script>
    @endif
</x-app-layout>
