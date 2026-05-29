<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl dark:border-slate-700 dark:bg-slate-900/80 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex h-18 items-center justify-between">

            <!-- Left -->
            <div class="flex items-center gap-8">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg">
                        🏠
                    </div>

                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-slate-900 dark:text-white">
                            RealEstate
                        </h1>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Management System
                        </p>
                    </div>
                </a>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center gap-2">

                    <a href="{{ route('dashboard') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition
                       {{ request()->routeIs('dashboard')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('properties.index') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition
                       {{ request()->routeIs('properties.*')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Properties
                    </a>

                    <!-- 👤 TENANTS -->
                    <a href="{{ route('tenants.index') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition
                       {{ request()->routeIs('tenants.*')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Tenants
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.properties.index') }}"
                           class="rounded-xl px-4 py-2 text-sm font-medium transition
                           {{ request()->routeIs('admin.properties.*')
                                ? 'bg-blue-600 text-white shadow'
                                : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                            Manage Properties
                        </a>
                    @endif

                    <!-- 📄 LEASES -->
                    <a href="{{ route('leases.index') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition
                       {{ request()->routeIs('leases.*')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Leases
                    </a>

                    <!-- 💰 PAYMENTS -->
                    <a href="{{ route('admin.payments.index') }}"
                    class="rounded-xl px-4 py-2 text-sm font-medium transition
                    {{ request()->routeIs('admin.payments.*')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Payments
                    </a>

                    <!-- 🛠 MAINTENANCE -->
                    <a href="{{ route('maintenance.index') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition
                       {{ request()->routeIs('maintenance.*')
                            ? 'bg-blue-600 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        Maintenance
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="rounded-xl px-4 py-2 text-sm font-medium transition
                           {{ request()->routeIs('admin.*')
                                ? 'bg-blue-600 text-white shadow'
                                : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                            Admin
                        </a>
                    @endif

                </div>
            </div>

            <!-- Right -->
            <div class="hidden md:flex items-center gap-4">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 shadow-sm transition hover:shadow-md dark:border-slate-700 dark:bg-slate-800">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-blue-600 text-sm font-bold text-white">
                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                            </div>

                            <div class="text-left">
                                <div class="text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile Settings
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>

            </div>

            <!-- Mobile Button -->
            <div class="flex md:hidden">

                <button @click="open = ! open"
                        class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': !open}"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>

                        <path :class="{'hidden': !open, 'inline-flex': open}"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
         class="border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-700 dark:bg-slate-900 md:hidden">

        <div class="space-y-2">

            <a href="{{ route('dashboard') }}" class="block px-4 py-3">Dashboard</a>
            <a href="{{ route('properties.index') }}" class="block px-4 py-3">Properties</a>
            <a href="{{ route('tenants.index') }}" class="block px-4 py-3">Tenants</a>
            <a href="{{ route('leases.index') }}" class="block px-4 py-3">Leases</a>
            <a href="{{ route('admin.payments.index') }}" class="block px-4 py-3">
                Payments
            </a>
            <a href="{{ route('maintenance.index') }}" class="block px-4 py-3">Maintenance</a>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.properties.index') }}" class="block px-4 py-3">Manage Properties</a>
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3">Admin</a>
            @endif

            <hr class="dark:border-slate-700">

            <a href="{{ route('profile.edit') }}" class="block px-4 py-3">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-3 text-red-600">
                    Logout
                </button>
            </form>

        </div>
    </div>

</nav>