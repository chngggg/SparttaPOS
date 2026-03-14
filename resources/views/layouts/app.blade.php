<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Spartta Motor - @yield('title')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS - Terpisah dan Terstruktur -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>

<body class="bg-krem font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-64">
            <!-- Header -->
            @include('partials.header')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gradient-to-b from-krem to-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden transition-opacity duration-300" id="sidebar-overlay"></div>

    <!-- Alpine.js untuk dropdown dan interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Axios untuk HTTP requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Custom JavaScript - Terpisah dan Terstruktur -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>