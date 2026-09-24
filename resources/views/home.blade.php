
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
                   class="shrink-0 flex items-center gap-2">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
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
                                aria-label="Search"
                                class="h-12 px-6 bg-indigo-600
                                       text-white
                                       rounded-r-lg
                                       hover:bg-indigo-700
                                       transition flex items-center justify-center"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>

                        </div>

                    </form>

                </div>


                <!-- User Account / Profile Dropdown -->
                @guest
                    <!-- Guest: Sign in & Register -->
                    <div class="hidden md:flex items-center gap-3">
                        <a href="{{ route('login') }}"
                           class="flex flex-col text-sm text-gray-700 hover:text-indigo-600 transition">
                            <span class="text-xs text-gray-500">Hello, Sign in</span>
                            <span class="font-semibold">Account</span>
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-3.5 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold text-xs rounded-lg transition">
                            Register
                        </a>
                    </div>
                @else
                    <!-- Authenticated: Profile Icon & Dropdown -->
                    <div class="flex items-center gap-3">
                        @if(auth()->user()->role === 'seller')
                            <a href="{{ route('seller.dashboard') }}"
                               class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-amber-500 via-indigo-600 to-purple-600 hover:from-amber-600 hover:to-purple-700 text-white font-bold text-xs shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                <span>🏪</span>
                                <span>Seller Dashboard</span>
                                <span>&rarr;</span>
                            </a>
                        @endif

                        <div class="relative" id="profileDropdownWrapper">
                            <button type="button"
                                    id="profileDropdownBtn"
                                    class="flex items-center gap-2.5 p-1.5 pr-2.5 rounded-full hover:bg-gray-100 transition border border-transparent hover:border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    aria-expanded="false"
                                    aria-haspopup="true">

                                <!-- Avatar Circle with Initial -->
                                <div class="w-10 h-10 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-indigo-600 ring-amber-300' : 'bg-gradient-to-tr from-indigo-600 to-purple-600' }} flex items-center justify-center text-white font-bold text-base shadow-sm ring-2">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>

                                <!-- Name & Chevron -->
                                <div class="hidden md:flex flex-col text-left">
                                    <span class="text-[11px] leading-tight text-gray-400 font-normal">
                                        {{ auth()->user()->role === 'seller' ? 'Seller Central' : 'Welcome,' }}
                                    </span>
                                    <span class="text-sm font-bold text-gray-800 leading-tight flex items-center gap-1">
                                        {{ Str::limit(auth()->user()->name, 12) }}
                                        <svg id="profileChevron" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </div>
                            </button>

                            <!-- Profile Dropdown Menu -->
                            <div id="profileDropdownMenu"
                                 class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 py-2 transition-all duration-150 transform opacity-0 scale-95 origin-top-right"
                                 style="box-shadow: 0 16px 40px -6px rgba(0, 0, 0, 0.18);">

                                <!-- User Info Header -->
                                <div class="px-4 py-3 border-b border-gray-100 {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-br from-amber-50/80 to-indigo-50/60' : 'bg-gradient-to-br from-indigo-50/80 to-purple-50/60' }} rounded-t-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-indigo-600' : 'bg-gradient-to-tr from-indigo-600 to-purple-600' }} flex items-center justify-center text-white font-bold text-lg shadow-sm ring-2 ring-white">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate">
                                                {{ auth()->user()->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                {{ auth()->user()->email }}
                                            </p>
                                            @if(auth()->user()->role === 'seller')
                                                <span class="inline-flex items-center gap-1 mt-1 px-2.5 py-0.5 text-[10px] font-bold tracking-wide uppercase bg-amber-100 text-amber-800 rounded-full border border-amber-200">
                                                    <span>🏪</span> Seller Account
                                                </span>
                                            @else
                                                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-700 rounded-full">
                                                    Customer
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if(auth()->user()->role === 'seller')
                                    <!-- Seller Prominent Dashboard Link -->
                                    <div class="p-2 border-b border-gray-100 bg-amber-50/40">
                                        <a href="{{ route('seller.dashboard') }}"
                                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 via-indigo-600 to-purple-600 hover:from-amber-600 hover:to-purple-700 text-white font-bold text-sm shadow-sm transition">
                                            <span class="flex items-center gap-2">
                                                <span class="text-base">🏪</span>
                                                <span>Go to Seller Dashboard</span>
                                            </span>
                                            <span>&rarr;</span>
                                        </a>
                                    </div>

                                    <!-- Seller Quick Links -->
                                    <div class="py-1">
                                        <a href="{{ route('seller.products.index') }}"
                                           class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <span>🛍️</span>
                                            <span>Manage Products</span>
                                        </a>
                                        <a href="{{ route('seller.orders.index') }}"
                                           class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <span>📦</span>
                                            <span>Customer Orders</span>
                                        </a>
                                        <a href="{{ route('seller.earnings') }}"
                                           class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <span>💰</span>
                                            <span>Earnings & Sales</span>
                                        </a>
                                        <a href="{{ route('seller.profile') }}"
                                           class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <span>⚙️</span>
                                            <span>Store Settings</span>
                                        </a>
                                    </div>
                                @else
                                    <!-- Customer Prominent Dashboard Link -->
                                    <div class="p-2 border-b border-gray-100">
                                        <a href="{{ url('/dashboard') }}"
                                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold text-sm shadow-sm hover:shadow-md hover:from-indigo-700 hover:to-purple-700 transition">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <span>Go to Dashboard</span>
                                            </span>
                                            <span>&rarr;</span>
                                        </a>
                                    </div>

                                    <!-- Customer Dropdown Links -->
                                    <div class="py-1">
                                        <a href="{{ url('/dashboard#account') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span>My Account</span>
                                        </a>

                                        <a href="{{ url('/dashboard#orders') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            <span>Recent Orders</span>
                                        </a>

                                        <a href="{{ url('/dashboard#history') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                            <span>Order History</span>
                                        </a>

                                        <a href="{{ url('/dashboard#settings') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50/70 hover:text-indigo-600 transition font-medium">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>Profile Settings</span>
                                        </a>
                                    </div>
                                @endif

                                <!-- Logout Form -->
                                <div class="border-t border-gray-100 pt-1">
                                    <form action="{{ auth()->user()->role === 'seller' ? route('seller.logout') : url('/logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit"
                                                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition text-left">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endguest



                <!-- Cart -->
                <a href="#"
                   class="relative flex items-center gap-2
                          text-gray-700
                          hover:text-indigo-600
                          font-semibold transition">

                    <svg class="w-7 h-7 text-gray-700 hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    <span class="hidden sm:inline">
                        Cart
                    </span>

                    <!-- Cart Count -->
                    <span
                        class="absolute -top-1.5 -right-2
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

                    @guest
                        <a href="{{ route('register') }}"
                           class="hover:text-indigo-300">
                            Join ShopSphere
                        </a>
                    @else
                        <a href="{{ auth()->user()->role === 'seller' ? route('seller.dashboard') : url('/dashboard') }}"
                           class="text-indigo-300 hover:text-white font-semibold flex items-center gap-1.5">
                            @if(auth()->user()->role === 'seller')
                                <span>🏪</span>
                                <span>Seller Dashboard</span>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>Dashboard</span>
                            @endif
                        </a>
                    @endguest

                </div>

            </div>

        </div>

    </header>


    <!-- Flash Messages (Success / Alert) -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 lg:px-6 pt-4">
            <div id="flashSuccessAlert"
                 class="flex items-center justify-between bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-3.5 rounded-xl shadow-lg transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold text-sm md:text-base">{{ session('success') }}</span>
                </div>
                <button type="button"
                        onclick="document.getElementById('flashSuccessAlert').remove()"
                        class="text-white/80 hover:text-white text-xl font-bold p-1 focus:outline-none">
                    &times;
                </button>
            </div>
        </div>
    @endif



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

                        <div class="w-24 h-24 mx-auto rounded-3xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white shadow-inner ring-1 ring-white/30">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
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
               class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                View All &rarr;
            </a>

        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">


            <!-- Category 1 -->
            <a href="{{ route('products') }}"
               class="group bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>

                <h3 class="font-bold text-lg mt-4 text-gray-900 group-hover:text-indigo-600 transition">
                    Electronics
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Phones, gadgets & more
                </p>

            </a>


            <!-- Category 2 -->
            <a href="{{ route('products') }}"
               class="group bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-pink-50 flex items-center justify-center text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>

                <h3 class="font-bold text-lg mt-4 text-gray-900 group-hover:text-pink-600 transition">
                    Fashion
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Clothing & accessories
                </p>

            </a>


            <!-- Category 3 -->
            <a href="{{ route('products') }}"
               class="group bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>

                <h3 class="font-bold text-lg mt-4 text-gray-900 group-hover:text-amber-600 transition">
                    Home & Living
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Make your home better
                </p>

            </a>


            <!-- Category 4 -->
            <a href="{{ route('products') }}"
               class="group bg-white rounded-2xl p-7 text-center
                      shadow-sm
                      hover:shadow-lg
                      hover:-translate-y-1
                      transition">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>

                <h3 class="font-bold text-lg mt-4 text-gray-900 group-hover:text-purple-600 transition">
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
                   class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                    View All &rarr;
                </a>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


                <!-- Product 1 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gradient-to-br from-indigo-50 to-blue-50
                                flex items-center justify-center">

                        <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1 text-gray-900">
                            Smart Mobile Phone
                        </h3>

                        <div class="flex items-center gap-1.5 mt-2">
                            <div class="flex text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">
                                (120)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold text-gray-900">
                                ₹14,999
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700
                                       transition text-sm font-semibold">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 2 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gradient-to-br from-pink-50 to-rose-50
                                flex items-center justify-center">

                        <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Fashion
                        </p>

                        <h3 class="font-bold text-lg mt-1 text-gray-900">
                            Running Shoes
                        </h3>

                        <div class="flex items-center gap-1.5 mt-2">
                            <div class="flex text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">
                                (86)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold text-gray-900">
                                ₹1,999
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700
                                       transition text-sm font-semibold">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 3 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gradient-to-br from-purple-50 to-indigo-50
                                flex items-center justify-center">

                        <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 18v-6a9 9 0 0118 0v6M3 18a3 3 0 003 3h1a1 1 0 001-1v-4a1 1 0 00-1-1H4a1 1 0 00-1 1v1zm18 0a3 3 0 01-3 3h-1a1 1 0 01-1-1v-4a1 1 0 011-1h3a1 1 0 011 1v1z" />
                        </svg>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1 text-gray-900">
                            Wireless Headphones
                        </h3>

                        <div class="flex items-center gap-1.5 mt-2">
                            <div class="flex text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">
                                (64)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold text-gray-900">
                                ₹2,499
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700
                                       transition text-sm font-semibold">
                                Add
                            </button>

                        </div>

                    </div>

                </div>


                <!-- Product 4 -->
                <div class="bg-gray-50 rounded-2xl overflow-hidden
                            hover:shadow-lg transition">

                    <div class="h-56 bg-gradient-to-br from-emerald-50 to-teal-50
                                flex items-center justify-center">

                        <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>

                    <div class="p-5">

                        <p class="text-sm text-indigo-600 font-medium">
                            Electronics
                        </p>

                        <h3 class="font-bold text-lg mt-1 text-gray-900">
                            Smart Watch
                        </h3>

                        <div class="flex items-center gap-1.5 mt-2">
                            <div class="flex text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">
                                (92)
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xl font-bold text-gray-900">
                                ₹3,499
                            </span>

                            <button
                                class="bg-indigo-600
                                       text-white
                                       px-4 py-2
                                       rounded-lg
                                       hover:bg-indigo-700
                                       transition text-sm font-semibold">
                                Add
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

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


            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition
                        flex items-center gap-5">

                <div class="w-20 h-20 rounded-2xl bg-indigo-50
                            flex items-center justify-center
                            text-indigo-600 shrink-0">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                <div>

                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">
                        Electronics
                    </p>

                    <h3 class="font-bold text-lg text-gray-900 mt-0.5">
                        Laptop
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2 text-lg">
                        ₹49,999
                    </p>

                </div>

            </div>


            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition
                        flex items-center gap-5">

                <div class="w-20 h-20 rounded-2xl bg-pink-50
                            flex items-center justify-center
                            text-pink-600 shrink-0">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>

                <div>

                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">
                        Fashion
                    </p>

                    <h3 class="font-bold text-lg text-gray-900 mt-0.5">
                        Travel Backpack
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2 text-lg">
                        ₹1,299
                    </p>

                </div>

            </div>


            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition
                        flex items-center gap-5">

                <div class="w-20 h-20 rounded-2xl bg-amber-50
                            flex items-center justify-center
                            text-amber-600 shrink-0">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>

                <div>

                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">
                        Home
                    </p>

                    <h3 class="font-bold text-lg text-gray-900 mt-0.5">
                        Modern Chair
                    </h3>

                    <p class="font-bold text-indigo-600 mt-2 text-lg">
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
                              hover:bg-gray-100
                              transition">
                        Join Now
                    </a>

                </div>


                <div class="bg-white/10 rounded-3xl p-8 text-white">

                    <div class="grid grid-cols-2 gap-6">

                        <div class="bg-white/10 rounded-xl p-5 hover:bg-white/15 transition">

                            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>

                            <h3 class="font-bold mt-3 text-base">
                                Referral Link
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Share with friends
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5 hover:bg-white/15 transition">

                            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>

                            <h3 class="font-bold mt-3 text-base">
                                Community
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Build your network
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5 hover:bg-white/15 transition">

                            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <h3 class="font-bold mt-3 text-base">
                                Benefits
                            </h3>

                            <p class="text-sm text-indigo-100 mt-1">
                                Eligible rewards
                            </p>

                        </div>


                        <div class="bg-white/10 rounded-xl p-5 hover:bg-white/15 transition">

                            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>

                            <h3 class="font-bold mt-3 text-base">
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

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-lg mt-4 text-gray-900">
                        Wide Selection
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Discover products across multiple categories.
                    </p>

                </div>


                <div class="text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-lg mt-4 text-gray-900">
                        Secure Shopping
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Shop with confidence on our platform.
                    </p>

                </div>


                <div class="text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-lg mt-4 text-gray-900">
                        Easy Ordering
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm">
                        Simple product discovery and ordering experience.
                    </p>

                </div>


                <div class="text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <h3 class="font-bold text-lg mt-4 text-gray-900">
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
                          hover:bg-indigo-700
                          transition">
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

                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-white">
                            ShopSphere
                        </h3>
                    </div>

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
                           class="block hover:text-white transition">
                            Home
                        </a>

                        <a href="{{ route('products') }}"
                           class="block hover:text-white transition">
                            Products
                        </a>

                        <a href="{{ route('about') }}"
                           class="block hover:text-white transition">
                            About Us
                        </a>

                        <a href="{{ route('contact') }}"
                           class="block hover:text-white transition">
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
                           class="block hover:text-white transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="block hover:text-white transition">
                            Register
                        </a>

                        <a href="/dashboard"
                           class="block hover:text-white transition">
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

                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>support@shopsphere.com</span>
                        </p>

                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+91 98765 43210</span>
                        </p>

                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-purple-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>ShopSphere Center, India</span>
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


    <!-- Profile Dropdown & UI Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('profileDropdownBtn');
            const menu = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');
            const wrapper = document.getElementById('profileDropdownWrapper');

            if (btn && menu) {
                function openMenu() {
                    menu.classList.remove('hidden');
                    // Small timeout for smooth animation
                    requestAnimationFrame(() => {
                        menu.classList.remove('opacity-0', 'scale-95');
                        menu.classList.add('opacity-100', 'scale-100');
                    });
                    if (chevron) chevron.classList.add('rotate-180');
                    btn.setAttribute('aria-expanded', 'true');
                }

                function closeMenu() {
                    menu.classList.remove('opacity-100', 'scale-100');
                    menu.classList.add('opacity-0', 'scale-95');
                    if (chevron) chevron.classList.remove('rotate-180');
                    btn.setAttribute('aria-expanded', 'false');
                    setTimeout(() => {
                        if (btn.getAttribute('aria-expanded') === 'false') {
                            menu.classList.add('hidden');
                        }
                    }, 150);
                }

                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                    if (isExpanded) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });

                // Close on click outside
                document.addEventListener('click', function (e) {
                    if (wrapper && !wrapper.contains(e.target)) {
                        closeMenu();
                    }
                });

                // Close on ESC key
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        closeMenu();
                    }
                });
            }

            // Auto-dismiss flash banner after 7 seconds
            const flash = document.getElementById('flashSuccessAlert');
            if (flash) {
                setTimeout(() => {
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateY(-10px)';
                    setTimeout(() => flash.remove(), 300);
                }, 7000);
            }
        });
    </script>

</body>
</html>


