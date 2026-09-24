<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                ShopSphere
            </a>

            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-indigo-600 transition">
                    Home
                </a>

                <a href="{{ route('products') }}"
                   class="text-gray-700 hover:text-indigo-600 transition">
                    Products
                </a>

                <a href="{{ route('about') }}"
                   class="text-indigo-600 font-semibold">
                    About Us
                </a>

                <a href="{{ route('contact') }}"
                   class="text-gray-700 hover:text-indigo-600 transition">
                    Contact
                </a>

                <a href="{{ route('login') }}"
                   class="text-gray-700 hover:text-indigo-600 transition">
                    Login
                </a>

                <a href="#"
                   class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Cart (0)</span>
                </a>

            </div>

        </div>
    </nav>


    <section class="bg-indigo-600 text-white py-20">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold">
                About ShopSphere
            </h1>

            <p class="mt-5 text-lg text-indigo-100">
                Your trusted online shopping platform.
            </p>

        </div>

    </section>


    <section class="py-16">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">

                <h2 class="text-3xl font-bold mb-6">
                    Who We Are
                </h2>

                <p class="text-gray-600 leading-7 mb-5">
                    ShopSphere is an online shopping platform designed to
                    provide customers with a simple, convenient and reliable
                    shopping experience.
                </p>

                <p class="text-gray-600 leading-7 mb-5">
                    Customers can explore products, add products to their cart,
                    place orders and manage their account from one platform.
                </p>

                <p class="text-gray-600 leading-7">
                    ShopSphere also includes a referral and MLM system that
                    allows users to participate in the platform's referral
                    program.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-md transition">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold mb-2 text-gray-900">
                        Quality Products
                    </h3>

                    <p class="text-gray-600">
                        Discover products across different categories.
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-md transition">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold mb-2 text-gray-900">
                        Secure Shopping
                    </h3>

                    <p class="text-gray-600">
                        Your account and order information are handled securely.
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-md transition">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold mb-2 text-gray-900">
                        Referral Program
                    </h3>

                    <p class="text-gray-600">
                        Invite others and participate in the ShopSphere
                        referral ecosystem.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <footer class="bg-gray-900 text-gray-300 py-8">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h3 class="text-xl font-bold text-white">
                ShopSphere
            </h3>

            <p class="mt-2">
                Your trusted online shopping platform.
            </p>

            <p class="mt-5 text-sm">
                © {{ date('Y') }} ShopSphere. All rights reserved.
            </p>

        </div>

    </footer>

</body>
</html>