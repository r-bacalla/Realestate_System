<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate Management System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-7xl bg-white rounded-[2rem] overflow-hidden shadow-2xl grid lg:grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="relative hidden lg:flex">

            <!-- Background Image -->
            <img
                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
                class="absolute inset-0 w-full h-full object-cover"
            >

            <!-- Overlay -->
            <div class="absolute inset-0 bg-slate-900/70"></div>

            <!-- Content -->
            <div class="relative z-10 p-14 flex flex-col justify-between text-white">

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-yellow-500 flex items-center justify-center text-2xl">
                        🏠
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            REAL ESTATE
                        </h1>
                        <p class="text-sm text-slate-200">
                            Management System
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="text-5xl font-bold leading-tight">
                        Manage Properties.<br>
                        Tenants.<br>
                        <span class="text-yellow-400">
                            Everything in One Place.
                        </span>
                    </h2>

                    <p class="mt-6 text-lg text-slate-200 max-w-lg">
                        A modern solution for managing properties,
                        leases, payments and maintenance.
                    </p>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-3 gap-4">

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                        <div class="text-2xl mb-2">🏢</div>
                        <h3 class="font-semibold">Properties</h3>
                        <p class="text-xs text-slate-300">
                            Manage listings
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                        <div class="text-2xl mb-2">👥</div>
                        <h3 class="font-semibold">Tenants</h3>
                        <p class="text-xs text-slate-300">
                            Track tenants
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                        <div class="text-2xl mb-2">📊</div>
                        <h3 class="font-semibold">Payments</h3>
                        <p class="text-xs text-slate-300">
                            Reports & analytics
                        </p>
                    </div>

                </div>

            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center justify-center p-8 lg:p-14 bg-white">

            <div class="w-full max-w-md">

                <!-- Logo -->
                <div class="text-center mb-8">

                    <div class="w-24 h-24 rounded-full bg-slate-900 text-white mx-auto flex items-center justify-center text-4xl shadow-lg">
                        🏠
                    </div>

                    <h2 class="mt-6 text-4xl font-bold text-slate-900">
                        Welcome Back
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Sign in to continue to your account
                    </p>
                </div>

                <!-- Login Form -->
                {{ $slot }}

                <p class="mt-10 text-center text-xs text-slate-400">
                    © {{ date('Y') }} Real Estate Management System
                </p>

            </div>
        </div>

    </div>

</div>

</body>
</html>