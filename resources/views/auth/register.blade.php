<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pengguna - SMP IT As-Sulthon</title>

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

        ```
        <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl overflow-hidden grid lg:grid-cols-2">

            <!-- LEFT -->
            <div
                class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-[#111827] via-[#1F2937] to-[#7A5C1E] p-12 text-white relative overflow-hidden">

                <div class="absolute -top-20 -right-20 w-64 h-64 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-8">
                        <img src="{{ asset('images/logo-sekolah.png') }}"
                            class="w-20 h-20 object-contain bg-white rounded-2xl p-2" alt="Logo Sekolah">

                        <div>
                            <h1 class="font-bold text-xl">
                                SMP IT AS-SULTHON
                            </h1>

                            <p class="text-sm text-[#F5E7B2]">
                                Sistem Manajemen Keuangan Sekolah
                            </p>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold leading-tight">
                        Registrasi Pengguna Baru
                    </h2>

                    <p class="mt-4 text-gray-200 leading-relaxed">
                        Tambahkan pengguna baru untuk mengakses sistem
                        manajemen keuangan sekolah sesuai hak akses yang diberikan.
                    </p>

                    <div class="mt-8 p-4 bg-white/10 rounded-2xl backdrop-blur">
                        <p class="text-sm">
                            👥 Administrator dapat membuat akun operator,
                            bendahara, maupun staf yang bertugas mengelola
                            keuangan sekolah.
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="p-8 lg:p-12">

                <div class="mb-8">
                    <div
                        class="w-14 h-14 bg-[#F5E7B2] text-[#7A5C1E] rounded-2xl flex items-center justify-center text-3xl mb-4">
                        👤
                    </div>

                    <h2 class="text-3xl font-bold text-[#111827]">
                        Buat Akun Baru
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Lengkapi data berikut untuk membuat akun pengguna.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus autocomplete="name" placeholder="Masukkan nama lengkap"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="user@sekolah.sch.id"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Masukkan password"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>

                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Ulangi password"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] py-3.5 text-[#111827] font-bold shadow-lg hover:opacity-90 transition">
                        Daftarkan Pengguna
                    </button>

                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-[#7A5C1E] hover:text-[#111827]">
                            Sudah memiliki akun? Masuk di sini
                        </a>
                    </div>
                </form>

                <div class="mt-8 p-4 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2]">
                    <p class="text-xs text-slate-600">
                        🔐 Akun yang dibuat akan digunakan untuk mengakses Sistem Manajemen Keuangan SMP IT As-Sulthon.
                    </p>
                </div>
            </div>

        </div>
    </div>
    ```

</body>

</html>
