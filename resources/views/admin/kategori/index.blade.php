<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-[#111827]">
                Data Kategori Biaya
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola kategori biaya siswa SMP IT As-Sulthon
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2rem] shadow border border-[#F5E7B2] overflow-hidden">

            <div
                class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-[#F5E7B2]">
                <div>
                    <h3 class="text-xl font-bold text-[#111827]">
                        Daftar Kategori
                    </h3>
                    <p class="text-sm text-slate-500">
                        Data kategori pembayaran dan potongan biaya siswa.
                    </p>
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-5 py-3 text-[#111827] font-bold shadow hover:opacity-90 transition">
                    + Tambah Kategori
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#111827] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama Kategori</th>
                            <th class="px-6 py-4 text-left">Biaya Dasar</th>
                            <th class="px-6 py-4 text-left">Potongan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($kategoris as $kategori)
                            <tr class="hover:bg-[#F8F6F0] transition">
                                <td class="px-6 py-4">
                                    {{ ++$i }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-[#111827]">
                                    {{ $kategori->nama_kategori }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($kategori->biaya_dasar, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $kategori->persentase_potongan ?? 0 }}%
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <button type="button" onclick="openModal('modal-{{ $kategori->id }}')"
                                            class="rounded-xl bg-blue-50 px-4 py-2 text-blue-700 font-semibold hover:bg-blue-100">
                                            Detail
                                        </button>

                                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                            class="rounded-xl bg-yellow-50 px-4 py-2 text-yellow-700 font-semibold hover:bg-yellow-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                                            method="POST" class="delete-form"
                                            data-nama="{{ $kategori->nama_kategori }}">
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
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-[#F5E7B2]">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL DI LUAR TABLE --}}
    @foreach ($kategoris as $kategori)
        <div id="modal-{{ $kategori->id }}" onclick="closeModal('modal-{{ $kategori->id }}')"
            class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 opacity-0 transition-opacity duration-300">

            <div onclick="event.stopPropagation()"
                class="modal-box w-full max-w-lg rounded-[2rem] bg-white shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300">

                <div class="bg-gradient-to-r from-[#111827] to-[#7A5C1E] p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold">
                                Detail Kategori
                            </h3>
                            <p class="text-sm text-[#F5E7B2]">
                                Informasi kategori biaya siswa
                            </p>
                        </div>

                        <button type="button" onclick="closeModal('modal-{{ $kategori->id }}')"
                            class="text-white text-2xl">
                            ×
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Nama Kategori</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $kategori->nama_kategori }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Biaya Dasar</p>
                        <p class="font-bold text-[#111827] mt-1">
                            Rp {{ number_format($kategori->biaya_dasar, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                        <p class="text-xs text-slate-500">Persentase Potongan</p>
                        <p class="font-bold text-[#111827] mt-1">
                            {{ $kategori->persentase_potongan ?? 0 }}%
                        </p>
                    </div>
                </div>

                <div class="p-6 border-t bg-slate-50 flex justify-end">
                    <button type="button" onclick="closeModal('modal-{{ $kategori->id }}')"
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
                    title: 'Hapus Kategori?',
                    html: `
                        <p>Kategori <b>${nama}</b> akan dihapus.</p>
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
