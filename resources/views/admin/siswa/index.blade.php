<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Data Siswa
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola data siswa SMP IT As-Sulthon
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div
                class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#F5E7B2]">
                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Daftar Siswa
                    </h3>
                    <p class="text-sm text-slate-500">
                        Data siswa, kelas, kategori biaya, dan status siswa.
                    </p>
                </div>

                <a href="{{ route('admin.siswa.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 text-[#111827] font-bold shadow hover:opacity-90 transition">
                    + Tambah Siswa
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">NIS</th>
                            <th class="px-6 py-4 text-left">Nama Siswa</th>
                            <th class="px-6 py-4 text-left">Kelas</th>
                            <th class="px-6 py-4 text-left">Kategori</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($siswas as $siswa)
                            <tr class="hover:bg-[#F8F6F0] transition">
                                <td class="px-6 py-4">
                                    {{ ++$i }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $siswa->nis }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-[#111827]">
                                    {{ $siswa->nama_siswa }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $siswa->kelas->nama_kelas ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $siswa->kategori->nama_kategori ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($siswa->status_aktif)
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <button type="button" onclick="openModal('modal-{{ $siswa->id }}')"
                                            class="rounded-xl bg-blue-50 px-4 py-2 text-blue-700 font-semibold hover:bg-blue-100">
                                            Detail
                                        </button>

                                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
                                            class="rounded-xl bg-yellow-50 px-4 py-2 text-yellow-700 font-semibold hover:bg-yellow-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                            class="delete-form" data-nama="{{ $siswa->nama_siswa }}">
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
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL DI LUAR TABLE --}}
    @foreach ($siswas as $siswa)
        <div id="modal-{{ $siswa->id }}" onclick="closeModal('modal-{{ $siswa->id }}')"
            class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 opacity-0 transition-opacity duration-300">

            <div onclick="event.stopPropagation()" class="modal-box w-full max-w-3xl max-h-[90vh] rounded-[2rem] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 flex flex-col">

                <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">
                                Detail Siswa
                            </h3>
                            <p class="text-sm text-[#F5E7B2]">
                                Informasi lengkap data siswa
                            </p>
                        </div>

                        <button type="button" onclick="closeModal('modal-{{ $siswa->id }}')"
                            class="text-white text-2xl">
                            ×
                        </button>
                    </div>
                </div>

                <div class="p-6 grid md:grid-cols-2 gap-4 overflow-y-auto">

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">NIS</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->nis }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Nama Siswa</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->nama_siswa }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Jenis Kelamin</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Tanggal Lahir</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->tanggal_lahir ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Kelas</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->kelas->nama_kelas ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Kategori</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->kategori->nama_kategori ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">No HP</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->no_hp ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Status</p>
                        <p class="font-bold mt-1">
                            @if ($siswa->status_aktif)
                                <span class="text-green-700">Aktif</span>
                            @else
                                <span class="text-red-700">Nonaktif</span>
                            @endif
                        </p>
                    </div>

                    <div class="md:col-span-2 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Alamat</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->alamat ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Nama Wali</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->nama_wali ?? '-' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">No HP Wali</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $siswa->no_hp_wali ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="p-6 border-t bg-slate-50 flex justify-end">
                    <button type="button" onclick="closeModal('modal-{{ $siswa->id }}')"
                        class="rounded-2xl bg-[#111827] px-5 py-2.5 text-white font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            const modalBox = modal.querySelector('.modal-box');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalBox.classList.remove('scale-95', 'opacity-0', 'translate-y-4');
                modalBox.classList.add('scale-100', 'opacity-100', 'translate-y-0');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const modalBox = modal.querySelector('.modal-box');

            modal.classList.add('opacity-0');
            modalBox.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
            modalBox.classList.add('scale-95', 'opacity-0', 'translate-y-4');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#D4AF37',
                background: '#ffffff',
                color: '#111827'
            });
        @endif

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const nama = this.dataset.nama;

                Swal.fire({
                    title: 'Hapus Siswa?',
                    html: `
                        <p>Data siswa <b>${nama}</b> akan dihapus.</p>
                        <small class="text-gray-500">
                            Data yang sudah dihapus tidak dapat dikembalikan.
                        </small>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    background: '#ffffff',
                    color: '#111827'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
