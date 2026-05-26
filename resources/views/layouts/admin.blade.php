<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    {{-- ADMIN NAVBAR --}}
    @include('layouts.navigation')

    <div class="flex">

        {{-- optional sidebar later --}}
        <div class="w-full p-6">
            @yield('content')
        </div>

    </div>

</body>
</html>