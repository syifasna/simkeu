<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SMP IT As-Sulthon</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div
        class="min-h-screen bg-gradient-to-br from-[#F8F6F0] via-white to-[#F5E7B2] flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-6xl bg-white rounded-[2rem] shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

            <!-- LEFT PANEL -->
            <div
                class="relative bg-gradient-to-br from-[#111827] via-[#1F2937] to-[#7A5C1E] p-10 lg:p-14 text-white overflow-hidden">

                <div class="absolute -top-24 -right-24 w-80 h-80 bg-[#D4AF37]/20 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#D4AF37]/20 rounded-full blur-2xl"></div>

                <div class="relative z-10">

                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-lg flex items-center justify-center">
                            <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMP IT As-Sulthon"
                                class="w-full h-full object-contain">
                        </div>

                        <div>
                            <h1 class="text-xl font-bold tracking-wide">
                                SMP IT AS-SULTHON
                            </h1>
                            <p class="text-xs text-[#F5E7B2]">
                                Sistem Manajemen Keuangan Sekolah
                            </p>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold leading-tight">
                        Kelola Keuangan Sekolah dengan Aman dan Teratur
                    </h2>

                    <p class="mt-5 text-gray-200 leading-relaxed">
                        Sistem ini membantu pengelolaan pembayaran siswa,
                        pemasukan, pengeluaran, dan laporan keuangan sekolah
                        secara rapi, transparan, dan mudah digunakan.
                    </p>

                    <div class="mt-8 border-l-4 border-[#D4AF37] pl-4">
                        <p class="text-sm text-gray-200 italic">
                            “Mendukung tata kelola keuangan sekolah yang tertib,
                            amanah, dan profesional.”
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-10">
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5 border border-white/10">
                            <div class="text-2xl mb-2">💰</div>
                            <h3 class="font-semibold text-[#F5E7B2]">Kas Sekolah</h3>
                            <p class="text-xs text-gray-300 mt-1">Pemasukan & pengeluaran</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5 border border-white/10">
                            <div class="text-2xl mb-2">🎓</div>
                            <h3 class="font-semibold text-[#F5E7B2]">Pembayaran</h3>
                            <p class="text-xs text-gray-300 mt-1">SPP dan tagihan siswa</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5 border border-white/10">
                            <div class="text-2xl mb-2">📊</div>
                            <h3 class="font-semibold text-[#F5E7B2]">Laporan</h3>
                            <p class="text-xs text-gray-300 mt-1">Rekap keuangan sekolah</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur rounded-2xl p-5 border border-white/10">
                            <div class="text-2xl mb-2">🔐</div>
                            <h3 class="font-semibold text-[#F5E7B2]">Akses Aman</h3>
                            <p class="text-xs text-gray-300 mt-1">Sesuai hak pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="p-8 sm:p-12 lg:p-14 flex flex-col justify-center">

                <div class="mb-8">
                    <div
                        class="w-14 h-14 bg-[#F5E7B2] text-[#7A5C1E] rounded-2xl flex items-center justify-center text-3xl mb-5 shadow-sm">
                        🔑
                    </div>

                    <h2 class="text-3xl font-bold text-[#111827]">
                        Masuk ke Sistem
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Silakan login untuk mengakses dashboard keuangan SMP IT As-Sulthon.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="admin@sekolah.sch.id"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>

                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-slate-300 text-[#D4AF37] shadow-sm focus:ring-[#D4AF37]"
                                name="remember">
                            <span class="ms-2 text-sm text-slate-600">
                                Ingat saya
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-semibold text-[#7A5C1E] hover:text-[#111827]">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-6 py-3.5 text-[#111827] font-bold shadow-lg shadow-yellow-100 hover:from-[#C9A227] hover:to-[#B88917] transition">
                        Masuk Dashboard
                    </button>
                </form>

                <div class="mt-8 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                    <p class="text-xs text-slate-600 leading-relaxed">
                        🔐 Sistem ini hanya dapat diakses oleh pengguna resmi SMP IT As-Sulthon.
                    </p>
                </div>

                <p class="mt-6 text-xs text-slate-400">
                    © {{ date('Y') }} SMP IT As-Sulthon. Sistem Manajemen Keuangan Sekolah.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
