<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-gradient-to-br from-slate-50 via-slate-100 to-sky-100 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6 px-4">
            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center gap-4">
                    <x-application-logo class="w-16 h-16 text-sky-600" />
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">{{ config('app.name', 'Real Estate System') }}</h1>
                        <p class="text-sm text-slate-600">Secure sign in and registration for your real estate admin portal.</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-lg lg:max-w-xl px-8 py-10 bg-white/95 backdrop-blur-xl border border-slate-200 shadow-xl rounded-[2rem]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
