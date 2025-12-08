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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow p-6">
                {{ $slot }}
            </main>

            <footer class="bg-white shadow border-t border-blue-600 p-6 mt-8">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
                    <!-- Sectie 1: Vendor call-to-action -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Word Vendor</h3>
                        <p class="text-gray-700 mb-2">Start je eigen shop en bereik duizenden klanten.</p>
                        <a href="{{ route('vendors.apply') }}" 
                        class="text-blue-600 font-semibold hover:underline">
                            Aanvragen
                        </a>
                    </div>

                    <!-- Sectie 2: Belangrijke links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Links</h3>
                        <ul class="space-y-1">
                            <li><a href="/" class="text-gray-700 hover:text-blue-600">Home</a></li>
                            <li><a href="/products" class="text-gray-700 hover:text-blue-600">Producten</a></li>
                            <li><a href="/about" class="text-gray-700 hover:text-blue-600">Over ons</a></li>
                            <li><a href="/contact" class="text-gray-700 hover:text-blue-600">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Sectie 3: Contact / Social media -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Contact</h3>
                        <p class="text-gray-700">support@buy.com</p>
                        <p class="text-gray-700">+31 6 12345678</p>
                        <div class="flex justify-center md:justify-start mt-2 space-x-4">
                            <a href="#" class="text-gray-700 hover:text-blue-600">Facebook</a>
                            <a href="#" class="text-gray-700 hover:text-blue-600">Twitter</a>
                            <a href="#" class="text-gray-700 hover:text-blue-600">Instagram</a>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-6 border-t pt-4 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} BUY.COM. All rights reserved.
                </div>
            </footer>        
        </div>
    </body>
</html>
