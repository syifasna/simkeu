<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - SMP IT As-Sulthon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#F8F6F0] via-white to-[#F5E7B2] flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-4xl bg-white rounded-[2rem] shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

            <!-- LEFT -->
            <div class="relative bg-gradient-to-br from-[#111827] via-[#1F2937] to-[#7A5C1E] p-10 text-white overflow-hidden">

                <div class="absolute -top-20 -right-20 w-64 h-64 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-[#D4AF37]/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <img
                        src="{{ asset('images/logo-sekolah.png') }}"
                        alt="Logo SMP IT As-Sulthon"
                        class="w-24 h-24 object-contain bg-white rounded-2xl p-2 shadow-lg mb-6"
                    >

                    <h1 class="text-3xl font-bold">
                        SMP IT AS-SULTHON
                    </h1>

                    <p class="mt-2 text-[#F5E7B2] text-sm">
                        Sistem Manajemen Keuangan Sekolah
                    </p>

                    <div class="mt-8 border-l-4 border-[#D4AF37] pl-4">
                        <p class="text-sm text-gray-200">
                            Halaman ini hanya dapat diakses oleh pengguna yang memiliki izin resmi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="p-10 flex flex-col justify-center text-center md:text-left">

                <div class="mx-auto md:mx-0 w-16 h-16 bg-[#F5E7B2] text-[#7A5C1E] rounded-2xl flex items-center justify-center text-4xl mb-6">
                    🔒
                </div>

                <h2 class="text-5xl font-bold text-[#111827]">
                    Oops!
                </h2>

                <p class="mt-4 text-xl font-semibold text-[#7A5C1E]">
                    Akses Ditolak
                </p>

                <p class="mt-3 text-slate-500 leading-relaxed">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                    Silakan kembali ke halaman utama atau hubungi administrator sekolah.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a
                        href="{{ url()->previous() }}"
                        class="w-full sm:w-auto text-center rounded-2xl bg-[#111827] px-6 py-3 text-white font-semibold hover:bg-[#1F2937] transition"
                    >
                        Kembali
                    </a>

                    <a
                        href="{{ route('dashboard') }}"
                        class="w-full sm:w-auto text-center rounded-2xl bg-gradient-to-r from-[#D4AF37] to-[#C9A227] px-6 py-3 text-[#111827] font-bold hover:opacity-90 transition"
                    >
                        Ke Dashboard
                    </a>
                </div>

                <div class="mt-8 rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
                    <p class="text-xs text-slate-600">
                        🔐 Sistem ini dilindungi untuk menjaga keamanan data keuangan SMP IT As-Sulthon.
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>