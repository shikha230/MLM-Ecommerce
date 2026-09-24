<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products - FreshBasket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="/" class="text-2xl font-bold text-green-600">
                FreshBasket
            </a>

            <div class="hidden md:flex items-center gap-8">

                <a href="/" class="text-gray-600 hover:text-green-600">
                    Home
                </a>

                <a href="/products" class="text-green-600 font-semibold">
                    Products
                </a>

                <a href="/about" class="text-gray-600 hover:text-green-600">
                    About Us
                </a>

                <a href="/contact" class="text-gray-600 hover:text-green-600">
                    Contact
                </a>

                <a href="/login"
                   class="text-gray-600 hover:text-green-600">
                    Login
                </a>

                <a href="/register"
                   class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Register
                </a>

            </div>

        </div>
    </nav>


    <!-- Page Header -->
    <section class="bg-green-600 text-white py-16">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-4xl md:text-5xl font-bold">
                Our Products
            </h1>

            <p class="mt-4 text-green-100 max-w-2xl mx-auto">
                Explore our wide range of quality products at affordable prices.
            </p>

        </div>

    </section>


    <!-- Search & Filters -->
    <section class="max-w-7xl mx-auto px-6 py-10">

        <div class="bg-white rounded-2xl shadow-sm p-6 mb-10">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input
                    type="text"
                    placeholder="Search products..."
                    class="border border-gray-300 rounded-lg px-4 py-3
                           focus:border-green-500 focus:ring-2
                           focus:ring-green-200 outline-none"
                >

                <select
                    class="border border-gray-300 rounded-lg px-4 py-3
                           focus:border-green-500 outline-none"
                >
                    <option>All Categories</option>
                    <option>Electronics</option>
                    <option>Fashion</option>
                    <option>Home & Living</option>
                    <option>Beauty</option>
                </select>

                <select
                    class="border border-gray-300 rounded-lg px-4 py-3
                           focus:border-green-500 outline-none"
                >
                    <option>Price Range</option>
                    <option>Under ₹500</option>
                    <option>₹500 - ₹1,000</option>
                    <option>₹1,000 - ₹5,000</option>
                    <option>Above ₹5,000</option>
                </select>

                <select
                    class="border border-gray-300 rounded-lg px-4 py-3
                           focus:border-green-500 outline-none"
                >
                    <option>Sort By</option>
                    <option>Newest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Popular</option>
                </select>

            </div>

        </div>


        <!-- Products -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


            <!-- Product 1 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">

                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400 text-5xl">📱</span>
                </div>

                <div class="p-5">

                    <p class="text-sm text-green-600 font-medium">
                        Electronics
                    </p>

                    <h3 class="text-lg font-semibold mt-1">
                        Smart Mobile Phone
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Latest smartphone with modern features.
                    </p>

                    <div class="flex items-center justify-between mt-5">

                        <span class="text-xl font-bold text-gray-900">
                            ₹14,999
                        </span>

                        <button
                            class="bg-green-600 text-white px-4 py-2 rounded-lg
                                   hover:bg-green-700"
                        >
                            View
                        </button>

                    </div>

                </div>

            </div>


            <!-- Product 2 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">

                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400 text-5xl">👟</span>
                </div>

                <div class="p-5">

                    <p class="text-sm text-green-600 font-medium">
                        Fashion
                    </p>

                    <h3 class="text-lg font-semibold mt-1">
                        Running Shoes
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Comfortable shoes for everyday use.
                    </p>

                    <div class="flex items-center justify-between mt-5">

                        <span class="text-xl font-bold text-gray-900">
                            ₹1,999
                        </span>

                        <button
                            class="bg-green-600 text-white px-4 py-2 rounded-lg
                                   hover:bg-green-700"
                        >
                            View
                        </button>

                    </div>

                </div>

            </div>


            <!-- Product 3 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">

                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400 text-5xl">🎧</span>
                </div>

                <div class="p-5">

                    <p class="text-sm text-green-600 font-medium">
                        Electronics
                    </p>

                    <h3 class="text-lg font-semibold mt-1">
                        Wireless Headphones
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Enjoy clear sound with wireless freedom.
                    </p>

                    <div class="flex items-center justify-between mt-5">

                        <span class="text-xl font-bold text-gray-900">
                            ₹2,499
                        </span>

                        <button
                            class="bg-green-600 text-white px-4 py-2 rounded-lg
                                   hover:bg-green-700"
                        >
                            View
                        </button>

                    </div>

                </div>

            </div>


            <!-- Product 4 -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">

                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-400 text-5xl">⌚</span>
                </div>

                <div class="p-5">

                    <p class="text-sm text-green-600 font-medium">
                        Electronics
                    </p>

                    <h3 class="text-lg font-semibold mt-1">
                        Smart Watch
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Track your activities and stay connected.
                    </p>

                    <div class="flex items-center justify-between mt-5">

                        <span class="text-xl font-bold text-gray-900">
                            ₹3,499
                        </span>

                        <button
                            class="bg-green-600 text-white px-4 py-2 rounded-lg
                                   hover:bg-green-700"
                        >
                            View
                        </button>

                    </div>

                </div>

            </div>


        </div>

    </section>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-16">

        <div class="max-w-7xl mx-auto px-6 py-10 text-center">

            <p class="text-2xl font-bold text-white">
                FreshBasket
            </p>

            <p class="mt-3 text-sm">
                Your trusted online shopping platform.
            </p>

            <p class="mt-6 text-sm text-gray-500">
                © {{ date('Y') }} FreshBasket. All rights reserved.
            </p>

        </div>

    </footer>

</body>
</html>
