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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=account_box" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite([
            'resources/css/app.css', 
            'resources/js/app.js', 
            'resources/js/categories.js',
            'resources/js/products.js',
            'resources/js/cart.js'
        ])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow border-b border-gray-200 py-3">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow p-6">
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error', 
                            title: 'Error!',
                            text: '{{ session('error') }}', 
                            toast: true, 
                            position: 'top', 
                            showConfirmButton: false,
                            timer: 10000 
                        });
                    </script>
                    @endif

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        </script>
                    @endif

                    @isset($slot)
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endisset
                </main>

            <footer class="bg-white shadow border-t border-blue-600 p-6 mt-8">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
                    <!-- Sectie 1: Vendor call-to-action -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Become a Vendor</h3>
                        <p class="text-gray-700 mb-2">Start your own shop and reach thousands of customers.</p>
                        <a href="{{ route('vendor.apply') }}" 
                        class="text-blue-600 font-semibold hover:underline">
                            Apply Now
                        </a>
                    </div>

                    <!-- Sectie 2: Belangrijke links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Links</h3>
                        <ul class="space-y-1">
                            <li><a href="/" class="text-gray-700 hover:text-blue-600">Home</a></li>
                            <li><a href="/products" class="text-gray-700 hover:text-blue-600">Products</a></li>
                            <li><a href="/about" class="text-gray-700 hover:text-blue-600">About us</a></li>
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
            
            <script>
                const vendor_items_url = "{{ route('products.data') }}";
                const category_url = "{{ route('categories.allCategories') }}";
                const index_items_url = "{{ route('products.index_data') }}";
                const search_url = "{{ route('products.search') }}";
                const category_filter_url = "{{ route('categories.filter') }}";
            </script>
            
        </div>
    </body>
</html>
