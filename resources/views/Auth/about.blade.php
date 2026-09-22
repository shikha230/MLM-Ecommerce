<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600">
                ShopSphere
            </a>

            <div class="flex items-center gap-8">

                <a href="{{ route('home') }}"
                   class="text-gray-600 hover:text-indigo-600">
                    Home
                </a>

                <a href="{{ route('products') }}"
                   class="text-gray-600 hover:text-indigo-600">
                    Products
                </a>

                <a href="{{ route('about') }}"
                   class="text-indigo-600 font-semibold">
                    About Us
                </a>

                <a href="{{ route('contact') }}"
                   class="text-gray-600 hover:text-indigo-600">
                    Contact
                </a>

            </div>

        </div>
    </nav>


    <section class="bg-indigo-600 text-white py-20">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-4xl md:text-5xl font-bold">
                About ShopSphere
            </h1>

            <p class="mt-4 text-indigo-100">
                Making online shopping simple and convenient.
            </p>

        </div>

    </section>


    <section class="max-w-5xl mx-auto px-6 py-16">

        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">

            <h2 class="text-3xl font-bold text-gray-900">
                Welcome to ShopSphere
            </h2>

            <p class="text-gray-600 mt-6 leading-7">
                ShopSphere is an online shopping platform where customers
                can discover products from different categories and enjoy
                a simple and convenient shopping experience.
            </p>

            <p class="text-gray-600 mt-4 leading-7">
                Our platform connects customers and sellers in one
                marketplace and provides features for shopping, orders,
                referrals and community participation.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

                <div class="bg-gray-50 rounded-xl p-6 text-center">
                    <div class="text-4xl">🛍️</div>
                    <h3 class="font-bold text-lg mt-4">
                        Easy Shopping
                    </h3>
                    <p class="text-gray-500 text-sm mt-2">
                        Simple and convenient product discovery.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 text-center">
                    <div class="text-4xl">🤝</div>
                    <h3 class="font-bold text-lg mt-4">
                        Trusted Marketplace
                    </h3>
                    <p class="text-gray-500 text-sm mt-2">
                        Connect with sellers and products.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 text-center">
                    <div class="text-4xl">🔗</div>
                    <h3 class="font-bold text-lg mt-4">
                        Referral Community
                    </h3>
                    <p class="text-gray-500 text-sm mt-2">
                        Participate in our referral ecosystem.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <footer class="bg-gray-900 text-gray-300">

        <div class="max-w-7xl mx-auto px-6 py-10 text-center">

            <p class="text-2xl font-bold text-white">
                ShopSphere
            </p>

            <p class="mt-3 text-sm">
                Your trusted online shopping platform.
            </p>

            <p class="mt-6 text-sm text-gray-500">
                © {{ date('Y') }} ShopSphere. All rights reserved.
            </p>

        </div>

    </footer>

</body>
</html>