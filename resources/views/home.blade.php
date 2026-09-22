```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShopSphere - Online Shopping</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">


    <!-- =========================================================
         TOP NAVBAR
    ========================================================== -->

    <header class="bg-white shadow-sm">

        <div class="max-w-7xl mx-auto px-4 lg:px-6">

            <div class="h-20 flex items-center gap-4">


                <!-- Logo -->
                <a href="{{ route('home') }}"
                   class="shrink-0">

                    <span class="text-2xl md:text-3xl font-extrabold text-indigo-600">
                        ShopSphere
                    </span>

                </a>


                <!-- Search Bar -->
                <div class="flex-1 max-w-3xl">

                    <form action="{{ route('products') }}" method="GET">

                        <div class="flex">

                            <input
                                type="text"
                                name="search"
                                placeholder="Search products..."
                                class="w-full h-12 px-5 border border-gray-300
                                       rounded-l-lg
                                       focus:outline-none
                                       focus:border-indigo-500
                                       focus:ring-2
                                       focus:ring-indigo-200"
                            >

                            <button
                                type="submit"
                                class="h-12 px-6 bg-indigo-600
                                       text-white
                                       rounded-r-lg
                                       hover:bg-indigo-700
                                       transition"
                            >
                                🔍
                            </button>

                        </div>

                    </form>

                </div>


                <!-- Account -->
                <a href="{{ route('login') }}"
                   class="hidden md:flex flex-col text-sm hover:text-indigo-600">

                    <span class="text-gray-500">
                        Hello, Sign in
                    </span>

                    <span class="font-semibold">
                        Account
                    </span>

                </a>


                <!-- Orders -->
                <a href="/dashboard"
                   class="hidden md:flex flex-col text-sm hover:text-indigo-600">

                    <span class="text-gray-500">
                        Your
                    </span>

                    <span class="font-semibold">
                        Orders
                    </span>

                </a>


                <!-- Cart -->
                <a href="#"
                   class="relative flex items-center gap-1
                          text-gray-700
                          hover:text-indigo-600
                          font-semibold">

                    <span class="text-3xl">
                        🛒
                    </span>

                    <span class="hidden sm:inline">
                        Cart
                    </span>

                    <!-- Cart Count -->
                    <span
                        class="absolute -top-2 -right-2
                               bg-red-500
                               text-white
                               text-xs
                               font-bold
                               w-5
                               h-5
                               rounded-full
                               flex
                               items-center
                               justify-center"
                    >
                        0
                    </span>

                </a>

            </div>

        </div>


        <!-- =====================================================
             SECONDARY NAVBAR
        ====================================================== -->

        <div class="bg-gray-900 text-white">

            <div class="max-w-7xl mx-auto px-4 lg:px-6">

                <div class="h-12 flex items-center gap-8 text-sm">

                    <a href="{{ route('home') }}"
                       class="font-semibold hover:text-indigo-300">
                        Home
                    </a>

                    <a href="{{ route('products') }}"
                       class="hover:text-indigo-300">
                        Products
                    </a>

                    <a href="{{ route('about') }}"
                       class="hover:text-indigo-300">
                        About Us
                    </a>

                    <a href="{{ route('contact') }}"
                       class="hover:text-indigo-300">
                        Contact
                    </a>

                    <a href="{{ route('register') }}"
                       class="hover:text-indigo-300">
                        Join ShopSphere
                    </a>

                </div>

            </div>

        </div>

    </header>



    <!-- =========================================================
         HERO SECTION
    ========================================================== -->

    <section class="bg-gradient-to-r from-indigo-600 to-purple-600">

        <div class="max-w-7xl mx-auto px-6 py-16 md:py-24">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">


                <!-- Hero Text -->
                <div class="text-white">

                    <p class="uppercase tracking-widest text-indigo-200
                              font-semibold text-sm">
                        Welcome to ShopSphere
                    </p>

                    <h1 class="text-4xl md:text-6xl font-extrabold mt-4 leading-tight">
                        Everything You Need,
                        <span class="text-indigo-200">
                            All in One Place
                        </span>
                    </h1>

                    <p class="mt-6 text-lg text-indigo-100 max-w-xl">
                        Discover quality products from trusted sellers,
                        enjoy convenient shopping and become part of the
                        ShopSphere community.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">

                        <a href="{{ route('products') }}"
                           class="bg-white text-indigo-600
                                  px-7 py-3
                                  rounded-lg
                                  font-bold
                                  hover:bg-gray-100
                                  transition">
                            Shop Now
                        </a>

                        <a href="{{ route('register') }}"
                           class="border border-white
                                  text-white
                                  px-7 py-3
                                  rounded-lg
                                  font-bold
                                  hover:bg-white
                                  hover:text-indigo-600
                                  transition">
                            Create Account
                        </a>

                    </div>

                </div>


                <!-- Hero Visual -->
                <div class="hidden lg:flex justify-center">

                    <div class="w-full max-w-md
                                bg-white/10
                                backdrop-blur-sm
                                rounded-3xl
                                p-10
                                text-center">

                        <div class="text-8xl">
                            🛍️
                        </div>

                        <h2 class="text-3xl font-bold text-white mt-6">
                            Shop Smart
                        </h2>

                        <p class="text-indigo-100 mt-3">
                            Find products you love at great prices.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================================
         SHOP BY CATEGORY
    ========================================================== -->

    <section class="max-w-7xl mx-auto px-6 py-14">

        <div class="flex items-center justify-between mb-8">

            <div>

                <p class="text-indigo-600 font-semibold text-sm uppercase">
                    Explore
                </p>

                <h2 class="text-3xl font-bold text-gray-900 mt-1">
                    Shop by Category
                </h2>

            </div>

            <a href="{{ route('products') }}"
               class="text-indigo-600 font-semibold hover:text-indigo-800">
                View All →
            </a>

        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">


            <!-- Category -->
            <a href="{{ route('products') }}"
               class="bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="text-5xl">
                    📱
                </div>

                <h3 class="font-bold text-lg mt-4">
                    Electronics
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Phones, gadgets & more
                </p>

            </a>


            <a href="{{ route('products') }}"
               class="bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="text-5xl">
                    👕
                </div>

                <h3 class="font-bold text-lg mt-4">
                    Fashion
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Clothing & accessories
                </p>

            </a>


            <a href="{{ route('products') }}"
               class="bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="text-5xl">
                    🏠
                </div>

                <h3 class="font-bold text-lg mt-4">
                    Home & Living
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Make your home better
                </p>

            </a>


            <a href="{{ route('products') }}"
               class="bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="text-5xl">
                    💄
                </div>

                <h3 class="font-bold text-lg mt-4">
                    Beauty
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Beauty & personal care
                </p>

            </a>

        </div>

    </section>



    <!-- =========================================================
         FEATURED PRODUCTS
    ========================================================== -->

    <section class="bg-white py-14">

        <div class="max-w-7xl mx-auto px-6">


            <div class="flex items-center justify-between mb-8">

                <div>

                    <p class="text-indigo-600 font-semibold text-sm uppercase">
                        Our Collection
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900 mt-1">
                        Featured Products
                    </h2>

                </div>

                <a href="{{ route('products') }}"
                   class="text-indigo-600 font-semibold hover:text-indigo-800">
                    View All →
                </a>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


                <!-- Product 1 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gray-100
                                flex items-center justify-center">

                        <span class="text-7xl">
                            📱
                        </span>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1">
                            Smart Mobile Phone
                        </h3>

                        <div class="flex items-center gap-1 mt-2">
                            <span class="text-yellow-500">
                                ★★★★★
                            </span>
                            <span class="text-sm text-gray-500">
                                (120)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold">
                                ₹14,999
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 2 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gray-100
                                flex items-center justify-center">

                        <span class="text-7xl">
                            👟
                        </span>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Fashion
                        </p>

                        <h3 class="font-bold text-lg mt-1">
                            Running Shoes
                        </h3>

                        <div class="flex items-center gap-1 mt-2">
                            <span class="text-yellow-500">
                                ★★★★★
                            </span>
                            <span class="text-sm text-gray-500">
                                (86)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold">
                                ₹1,999
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 3 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gray-100
                                flex items-center justify-center">

                        <span class="text-7xl">
                            🎧
                        </span>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1">
                            Wireless Headphones
                        </h3>

                        <div class="flex items-center gap-1 mt-2">
                            <span class="text-yellow-500">
                                ★★★★★
                            </span>
                            <span class="text-sm text-gray-500">
                                (64)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold">
                                ₹2,499
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 4 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gray-100
                                flex items-center justify-center">

                        <span class="text-7xl">
                            ⌚
                        </span>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1">
                            Smart Watch
                        </h3>

                        <div class="flex items-center gap-1 mt-2">
                            <span class="text-yellow-500">
                                ★★★★★
                            </span>
                            <span class="text-sm text-gray-500">
                                (92)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold">
                                ₹3,499
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700">
                                Add
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================================
         POPULAR PRODUCTS
    ========================================================== -->

    <section class="max-w-7xl mx-auto px-6 py-14">

        <div class="mb-8">

            <p class="text-indigo-600 font-semibold text-sm uppercase">
                Popular
            </p>

            <h2 class="text-3xl font-bold text-gray-900 mt-1">
                Popular Products
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


            <div class="bg-white rounded-2xl p-6 shadow-sm
                        flex items-center gap-5">

                <div class="w-24 h-24 rounded-xl bg-gray-100
                            flex items-center justify-center
                            text-5xl">
                    💻
                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Electronics
                    </p>

                    <h3 class="font-bold text-lg">
                        Laptop
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2">
                        ₹49,999
                    </p>

                </div>

            </div>


            <div class="bg-white rounded-2xl p-6 shadow-sm
                        flex items-center gap-5">

                <div class="w-24 h-24 rounded-xl bg-gray-100
                            flex items-center justify-center
                            text-5xl">
                    🎒
                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Fashion
                    </p>

                    <h3 class="font-bold text-lg">
                        Travel Backpack
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2">
                        ₹1,299
                    </p>

                </div>

            </div>


            <div class="bg-white rounded-2xl p-6 shadow-sm
                        flex items-center gap-5">

                <div class="w-24 h-24 rounded-xl bg-gray-100
                            flex items-center justify-center
                            text-5xl">
                    🪑
                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Home
                    </p>

                    <h3 class="font-bold text-lg">
                        Modern Chair
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2">
                        ₹4,999
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================================
         REFERRAL / MLM SECTION
    ========================================================== -->

    <section class="bg-indigo-600 py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">


                <div class="text-white">

                    <p class="text-indigo-200 uppercase
                              tracking-widest font-semibold text-sm">
                        ShopSphere Community
                    </p>

                    <h2 class="text-3xl md:text-4xl font-bold mt-3">
                        Invite Friends & Grow Together
                    </h2>

                    <p class="text-indigo-100 mt-5 leading-7">
                        Join the ShopSphere referral community.
                        Share your referral link with friends and
                        participate in eligible referral benefits.
                    </p>

                    <a href="{{ route('register') }}"
                       class="inline-block mt-7
                              bg-white
                              text-indigo-600
                              px-7 py-3
                              rounded-lg
                              font-bold
                              hover:bg-gray-100">
                        Join Now
                    </a>

                </div>


                <div class="bg-white/10 rounded-3xl p-8 text-white">

                    <div class="grid grid-cols-2 gap-6">

                        <div class="bg-white/10 rounded-xl p-5">

                            <div class="text-3xl">
                                🔗
                            </div>

                            <h3 class="font-bold mt-3">
                                Referral Link
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Share with friends
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5">

                            <div class="text-3xl">
                                👥
                            </div>

                            <h3 class="font-bold mt-3">
                                Community
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Build your network
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5">

                            <div class="text-3xl">
                                💰
                            </div>

                            <h3 class="font-bold mt-3">
                                Benefits
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Eligible rewards
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5">

                            <div class="text-3xl">
                                📈
                            </div>

                            <h3 class="font-bold mt-3">
                                Grow
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Grow together
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================================
         WHY SHOP WITH US
    ========================================================== -->

    <section class="bg-white py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <p class="text-indigo-600 uppercase
                          tracking-widest
                          font-semibold text-sm">
                    Shop With Confidence
                </p>

                <h2 class="text-3xl font-bold text-gray-900 mt-2">
                    Why Shop With Us?
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">


                <div class="text-center">

                    <div class="text-5xl">
                        🛍️
                    </div>

                    <h3 class="font-bold text-lg mt-4">
                        Wide Selection
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Discover products across multiple categories.
                    </p>

                </div>


                <div class="text-center">

                    <div class="text-5xl">
                        🔒
                    </div>

                    <h3 class="font-bold text-lg mt-4">
                        Secure Shopping
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Shop with confidence on our platform.
                    </p>

                </div>


                <div class="text-center">

                    <div class="text-5xl">
                        🚚
                    </div>

                    <h3 class="font-bold text-lg mt-4">
                        Easy Ordering
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Simple product discovery and ordering experience.
                    </p>

                </div>


                <div class="text-center">

                    <div class="text-5xl">
                        🤝
                    </div>

                    <h3 class="font-bold text-lg mt-4">
                        Trusted Community
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Connect with sellers and our growing community.
                    </p>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================================
         NEWSLETTER / CTA
    ========================================================== -->

    <section class="bg-gray-900 py-14">

        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="text-3xl font-bold text-white">
                Ready to Start Shopping?
            </h2>

            <p class="text-gray-400 mt-3">
                Create your ShopSphere account and explore our marketplace.
            </p>

            <div class="mt-7">

                <a href="{{ route('products') }}"
                   class="inline-block
                          bg-indigo-600
                          text-white
                          px-8 py-3
                          rounded-lg
                          font-semibold
                          hover:bg-indigo-700">
                    Explore Products
                </a>

            </div>

        </div>

    </section>



    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer class="bg-black text-gray-400">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">


                <!-- Brand -->
                <div>

                    <h3 class="text-2xl font-bold text-white">
                        ShopSphere
                    </h3>

                    <p class="mt-4 text-sm leading-6">
                        Your online shopping destination for
                        quality products and a convenient shopping experience.
                    </p>

                </div>


                <!-- Quick Links -->
                <div>

                    <h4 class="text-white font-semibold">
                        Quick Links
                    </h4>

                    <div class="mt-4 space-y-3 text-sm">

                        <a href="{{ route('home') }}"
                           class="block hover:text-white">
                            Home
                        </a>

                        <a href="{{ route('products') }}"
                           class="block hover:text-white">
                            Products
                        </a>

                        <a href="{{ route('about') }}"
                           class="block hover:text-white">
                            About Us
                        </a>

                        <a href="{{ route('contact') }}"
                           class="block hover:text-white">
                            Contact
                        </a>

                    </div>

                </div>


                <!-- Account -->
                <div>

                    <h4 class="text-white font-semibold">
                        Account
                    </h4>

                    <div class="mt-4 space-y-3 text-sm">

                        <a href="{{ route('login') }}"
                           class="block hover:text-white">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="block hover:text-white">
                            Register
                        </a>

                        <a href="/dashboard"
                           class="block hover:text-white">
                            My Account
                        </a>

                    </div>

                </div>


                <!-- Contact -->
                <div>

                    <h4 class="text-white font-semibold">
                        Contact
                    </h4>

                    <div class="mt-4 space-y-3 text-sm">

                        <p>
                            📧 support@shopsphere.com
                        </p>

                        <p>
                            📞 +91 98765 43210
                        </p>

                        <p>
                            📍 India
                        </p>

                    </div>

                </div>

            </div>


            <div class="border-t border-gray-800 mt-10 pt-6 text-center">

                <p class="text-sm">
                    © {{ date('Y') }} ShopSphere. All rights reserved.
                </p>

            </div>

        </div>

    </footer>


</body>
</html>
```
