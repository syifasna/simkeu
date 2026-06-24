<aside
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#111827] border-r-4 border-[#D4AF37] text-white hidden lg:flex flex-col">

    <!-- LOGO -->
    <div class="h-24 flex items-center gap-3 px-6 border-b border-white/10">
        <div class="w-14 h-14 bg-white rounded-xl p-1.5 shadow">
            <img src="{{ asset('images/logo-sekolah.png') }}" class="w-full h-full object-contain" alt="Logo">
        </div>

        <div>
            <h1 class="font-bold leading-tight">SMP IT AS-SULTHON</h1>
            <p class="text-xs text-[#F5E7B2]">Manajemen Keuangan</p>
        </div>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

        @php
            if (Auth::user()->role === 'admin') {
                $dashboardRoute = route('admin.dashboard');
            } elseif (Auth::user()->role === 'staff') {
                $dashboardRoute = route('staff.dashboard');
            } else {
                $dashboardRoute = route('dashboard');
            }
        @endphp

        <a href="{{ $dashboardRoute }}"
            class="{{ request()->routeIs('dashboard') ||
            request()->routeIs('admin.dashboard') ||
            request()->routeIs('staff.dashboard')
                ? 'bg-[#D4AF37] text-[#111827] font-semibold shadow-lg'
                : 'text-gray-200 hover:bg-white/10 hover:text-[#F5E7B2]' }}
        flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200">
            🏠 <span>Dashboard</span>
        </a>

        {{-- ================= ADMIN ================= --}}
        @if (Auth::user()->role === 'admin')
            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">
                    Data Master
                </p>

                <a href="{{ route('admin.kategori.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    🏷️ <span>Kategori Siswa</span>
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.kelas.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    🏫 <span>Data Kelas</span>
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.siswa.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    🎓 <span>Data Siswa</span>
                </a>

                <a href="{{ route('admin.staff.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.staff.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    💼 <span>Data Staff</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    👤 <span>Data User</span>
                </a>
            </div>

            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">
                    Billing
                </p>

                <a href="{{ route('admin.billing.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.billing.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    💳 <span>Generate Tagihan</span>
                </a>
            </div>

            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">Transaksi Keuangan</p>

                <a href="{{ route('admin.pemasukan.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.pemasukan.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📥 <span>Pemasukan</span>
                </a>
                <a href="{{ route('admin.pengeluaran.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.pengeluaran.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📤 <span>Pengeluaran</span>
                </a>
            </div>

            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">
                    Laporan
                </p>

                <a href="{{ route('admin.laporan.spp') }}"
                    class="sidebar-link {{ request()->routeIs('admin.laporan.spp*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📄 <span>Lap. Pembayaran SPP</span>
                </a>

                <a href="{{ route('admin.laporan.pemasukan') }}"
                    class="sidebar-link {{ request()->routeIs('admin.laporan.pemasukan*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📄 <span>Lap. Pemasukan</span>
                </a>

                <a href="{{ route('admin.laporan.pengeluaran') }}"
                    class="sidebar-link {{ request()->routeIs('admin.laporan.pengeluaran*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📄 <span>Lap. Pengeluaran</span>
                </a>

                <a href="{{ route('admin.laporan.aruskas') }}"
                    class="sidebar-link {{ request()->routeIs('admin.laporan.aruskas*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📊 <span>Lap. Arus Kas</span>
                </a>
            </div>

            {{-- ================= STAFF ================= --}}
        @elseif(Auth::user()->role === 'staff')
            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">
                    Billing
                </p>

                <a href="{{ route('admin.billing.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.billing.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    💳 <span>Pembayaran SPP</span>
                </a>
            </div>

            {{-- ================= USER ================= --}}
        @else
            <div class="pt-4">
                <p class="px-4 mb-2 text-xs uppercase tracking-wider text-gray-400">
                    Pembayaran SPP
                </p>

                <a href="{{ route('user.tagihan') }}"
                    class="sidebar-link {{ request()->routeIs('user.tagihan.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    💳 <span>Tagihan Saya</span>
                </a>

                <a href="{{ route('user.pembayaran') }}"
                    class="sidebar-link {{ request()->routeIs('user.pembayaran.*') ? 'sidebar-link-active' : 'sidebar-link-inactive' }}">
                    📜 <span>Riwayat Pembayaran</span>
                </a>
            </div>
        @endif

    </nav>
</aside>

<style>
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        color: #e5e7eb;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #F5E7B2;
    }
</style>
