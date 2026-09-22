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
               class="text-2xl font-bold text-indigo-600">
                ShopSphere
            </a>

            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-indigo-600">
                    Home
                </a>

                <a href="{{ route('products') }}"
                   class="text-gray-700 hover:text-indigo-600">
                    Products
                </a>

                <a href="{{ route('about') }}"
                   class="text-indigo-600 font-semibold">
                    About Us
                </a>

                <a href="{{ route('contact') }}"
                   class="text-gray-700 hover:text-indigo-600">
                    Contact
                </a>

                <a href="{{ route('login') }}"
                   class="text-gray-700 hover:text-indigo-600">
                    Login
                </a>

                <a href="#"
                   class="text-gray-700">
                    🛒 Cart (0)
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

                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <div class="text-4xl mb-4">🛍️</div>

                    <h3 class="text-xl font-bold mb-2">
                        Quality Products
                    </h3>

                    <p class="text-gray-600">
                        Discover products across different categories.
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <div class="text-4xl mb-4">🔒</div>

                    <h3 class="text-xl font-bold mb-2">
                        Secure Shopping
                    </h3>

                    <p class="text-gray-600">
                        Your account and order information are handled securely.
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <div class="text-4xl mb-4">🤝</div>

                    <h3 class="text-xl font-bold mb-2">
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