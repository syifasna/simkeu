<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <title>SMP IT As-Sulthon</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1rem;
            border-radius: .75rem;
            font-size: .875rem;
            transition: all .2s;
        }

        .sidebar-link-active {
            background: #D4AF37;
            color: #111827 !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(212, 175, 55, .3);
        }

        .sidebar-link-inactive {
            color: #e5e7eb;
        }

        .sidebar-link-inactive:hover {
            background: rgba(255, 255, 255, .1);
            color: #F5E7B2;
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#F8F6F0]">
    <div class="min-h-screen bg-gradient-to-br from-[#F8F6F0] via-white to-[#F5E7B2]">

        @include('layouts.navigation')

        <div class="lg:ml-72">

            <!-- TOPBAR -->
            <div class="h-20 bg-white border-b border-[#F5E7B2] flex items-center justify-between px-8 shadow-sm">

                <div>
                    <h1 class="text-xl font-bold text-[#111827]">
                        Sistem Manajemen Keuangan
                    </h1>
                    <p class="text-sm text-slate-500">
                        SMP IT As-Sulthon
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <div class="text-right">
                        <p class="font-semibold text-[#111827]">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-slate-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3">

                                <div
                                    class="w-11 h-11 rounded-full bg-[#D4AF37] text-[#111827]
                                    flex items-center justify-center font-bold text-lg shadow">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                👤 Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                            this.closest('form').submit();">

                                    🚪 Logout
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>

                </div>
            </div>

            {{-- @isset($header)
                <header class="bg-white/80 backdrop-blur border-b border-[#F5E7B2]">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <main class="py-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
