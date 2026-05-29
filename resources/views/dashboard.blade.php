<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Welcome back, {{ auth()->user()->name }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 dark:bg-slate-900 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Banner -->
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-violet-700 shadow-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between p-8">

                    <div class="max-w-2xl">
                        <h1 class="text-3xl sm:text-4xl font-bold text-white">
                            Real Estate Management
                        </h1>

                        <p class="mt-3 text-blue-100 leading-relaxed">
                            Manage properties, listings, and account settings
                            from one professional dashboard.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('properties.index') }}"
                               class="rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-blue-700 shadow-md transition duration-200 hover:scale-105 hover:shadow-lg">
                                Browse Properties
                            </a>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                   class="rounded-2xl border border-white/30 bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                                    Admin Panel
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 lg:mt-0 flex justify-center">
                        <div class="rounded-3xl bg-white/10 p-6 backdrop-blur shadow-lg">
                            <div class="text-6xl">
                                🏠
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                <!-- Welcome Card -->
                <div class="rounded-3xl bg-white dark:bg-gray-800 p-6 shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center gap-4">
                        <div class="rounded-2xl bg-blue-100 dark:bg-blue-900 p-3 text-2xl">
                            👋
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                Welcome Back
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Ready to manage your listings?
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 text-sm leading-6 text-gray-600 dark:text-gray-300">
                        Use your dashboard to monitor properties,
                        update listings, and keep your real estate
                        platform organized.
                    </p>
                </div>

                <!-- Properties Card -->
                <div class="rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 text-white shadow-xl hover:shadow-2xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-100">
                                Listings
                            </p>

                            <h3 class="mt-2 text-2xl font-bold">
                                Properties
                            </h3>
                        </div>

                        <div class="text-4xl">
                            🏘️
                        </div>
                    </div>

                    <a href="{{ route('properties.index') }}"
                       class="mt-6 inline-flex rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                        View Listings
                    </a>
                </div>

                <!-- Account Card -->
                <div class="rounded-3xl bg-white dark:bg-gray-800 p-6 shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Account
                            </p>

                            <h3 class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                                Profile Settings
                            </h3>
                        </div>

                        <div class="text-4xl">
                            ⚙️
                        </div>
                    </div>

                    <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                        Update your profile and account preferences.
                    </p>

                    <a href="{{ route('profile.edit') }}"
                       class="mt-6 inline-flex rounded-2xl border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200 transition hover:bg-gray-100 dark:hover:bg-gray-700">
                        Edit Profile
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>