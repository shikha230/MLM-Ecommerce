
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshBasket - India's Fresh Grocery Store</title>
    <meta name="description" content="Order fresh fruits, vegetables, dairy, grains, spices and more from FreshBasket. Daily fresh delivery to your doorstep.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f0fdf4;
            color: #1e293b;
        }
        :root {
            --green-primary:   #16a34a;
            --green-dark:      #15803d;
            --green-light:     #22c55e;
            --green-50:        #f0fdf4;
            --green-100:       #dcfce7;
            --green-600:       #16a34a;
            --green-700:       #15803d;
        }
        /* ——— Navbar ——— */
        .navbar { background: #fff; box-shadow: 0 1px 0 rgba(0,0,0,.06); position: sticky; top: 0; z-index: 100; }
        .search-input { border: 1.5px solid #d1fae5; border-right: none; background: #f0fdf4; transition: all .2s; }
        .search-input:focus { outline: none; border-color: #16a34a; background: #fff; box-shadow: 0 0 0 3px rgba(22,163,74,.1); }
        .search-btn { background: linear-gradient(135deg, #16a34a, #15803d); border: none; cursor: pointer; transition: all .2s; }
        .search-btn:hover { background: linear-gradient(135deg, #15803d, #166534); }
        /* ——— Main Nav Bar & Links ——— */
        .main-nav-bar {
            background: linear-gradient(135deg, #064e3b 0%, #047857 50%, #065f46 100%) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 12px rgba(20, 83, 45, 0.15);
        }
        .nav-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 700;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-link-btn:hover {
            background: rgba(255, 255, 255, 0.18) !important;
            color: #ffffff !important;
        }
        .nav-link-btn.active {
            background: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
        }
        .register-btn {
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            padding: 8px 18px !important;
            border-radius: 10px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.25) !important;
            border: none !important;
        }
        .register-btn:hover {
            background: linear-gradient(135deg, #15803d, #166534) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.35) !important;
        }
        /* ——— Hero ——— */
        .hero { background: linear-gradient(135deg, #14532d 0%, #166534 30%, #15803d 60%, #16a34a 100%); position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        /* ——— Category cards ——— */
        .cat-card { background: #fff; border: 1px solid #dcfce7; border-radius: 16px; transition: all .25s; cursor: pointer; }
        .cat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(22,163,74,.15); border-color: #86efac; }
        /* ——— Product cards ——— */
        .prod-card { background: #fff; border: 1px solid #e7f9ee; border-radius: 16px; transition: all .25s; overflow: hidden; }
        .prod-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(22,163,74,.13); }
        .prod-card .badge { font-size: 10px; font-weight: 700; letter-spacing: .5px; padding: 2px 8px; border-radius: 20px; }
        .badge-offer  { background: #fef3c7; color: #92400e; }
        .badge-fresh  { background: #dcfce7; color: #14532d; }
        .badge-popular{ background: #fee2e2; color: #991b1b; }
        .add-btn { background: linear-gradient(135deg, #16a34a, #15803d); color: #fff; border: none; border-radius: 8px; padding: 7px 14px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all .2s; font-family: inherit; display: flex; align-items: center; gap: 5px; }
        .add-btn:hover { background: linear-gradient(135deg, #15803d, #166534); transform: scale(1.03); }
        /* ——— Promo banner ——— */
        .promo-green { background: linear-gradient(135deg, #14532d, #166534); }
        .promo-orange { background: linear-gradient(135deg, #c2410c, #ea580c); }
        /* ——— Trust bar ——— */
        .trust-item { text-align: center; }
        /* ——— Section label ——— */
        .section-label { font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #16a34a; }
        /* ——— Footer ——— */
        .footer-main { background: #0f172a; }
    </style>
</head>

<body>

<!-- =========================================================
     ANNOUNCEMENT BAR
========================================================== -->
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white text-center py-2 text-xs font-semibold tracking-wide">
    Free delivery on orders above ₹499 &nbsp;|&nbsp; 100% Fresh & Certified Produce &nbsp;|&nbsp; Support: 1800-123-4567
</div>

<!-- =========================================================
     TOP NAVBAR
========================================================== -->
<header class="navbar">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="h-18 py-3 flex items-center gap-4">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2">
                <div class="w-9 h-9 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-sm">
                    🛒
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-xl font-extrabold text-green-700 tracking-tight">FreshBasket</span>
                    <span class="text-[10px] text-green-500 font-semibold -mt-0.5">Farm to Doorstep</span>
                </div>
            </a>

            <!-- Location Selector -->
            <button class="hidden md:flex items-center gap-1.5 text-sm text-slate-600 hover:text-green-700 transition border-r border-slate-200 pr-4 shrink-0">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div class="flex flex-col leading-tight text-left">
                    <span class="text-[10px] text-slate-400">Deliver to</span>
                    <span class="font-bold text-slate-800 text-xs">Select Location</span>
                </div>
            </button>

            <!-- Search Bar -->
            <div class="flex-1 max-w-2xl">
                <form action="{{ route('products') }}" method="GET">
                    <div class="flex rounded-xl overflow-hidden shadow-sm">
                        <input type="text" name="search"
                            placeholder="Search for vegetables, fruits, dairy..."
                            class="search-input w-full h-11 px-4 text-sm text-slate-800 font-medium"
                            value="{{ request('search') }}">
                        <button type="submit" aria-label="Search" class="search-btn h-11 px-5 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Account -->
            @guest
                <div class="hidden md:flex items-center gap-3 shrink-0">
                    <a href="{{ route('login') }}" class="flex flex-col text-sm text-gray-700 hover:text-green-700 transition">
                        <span class="text-xs text-gray-500">Hello, Sign in</span>
                        <span class="font-bold">Account</span>
                    </a>
                    <a href="{{ route('register') }}" class="register-btn">
                        Register
                    </a>
                </div>
            @else
                <div class="flex items-center gap-3 shrink-0">
                    @if(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}"
                           class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold text-xs shadow-sm transition">
                            <span>🏪</span>
                            <span>Seller Dashboard</span>
                        </a>
                    @endif

                    <div class="relative" id="profileDropdownWrapper">
                        <button type="button" id="profileDropdownBtn"
                                class="flex items-center gap-2.5 p-1.5 pr-2.5 rounded-full hover:bg-green-50 transition border border-transparent hover:border-green-200 focus:outline-none focus:ring-2 focus:ring-green-500"
                                aria-expanded="false" aria-haspopup="true">
                            <div class="w-9 h-9 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-green-600' : 'bg-gradient-to-tr from-green-500 to-emerald-700' }} flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-green-200">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-[10px] leading-tight text-gray-400">{{ auth()->user()->role === 'seller' ? 'Seller' : 'Welcome,' }}</span>
                                <span class="text-sm font-bold text-gray-800 leading-tight flex items-center gap-1">
                                    {{ Str::limit(auth()->user()->name, 10) }}
                                    <svg id="profileChevron" class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div id="profileDropdownMenu"
                             class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 py-2 transition-all duration-150 transform opacity-0 scale-95 origin-top-right">
                            <!-- Header -->
                            <div class="px-4 py-3 border-b border-gray-100 {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-br from-amber-50 to-green-50' : 'bg-gradient-to-br from-green-50 to-emerald-50' }} rounded-t-2xl">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-green-600' : 'bg-gradient-to-tr from-green-500 to-emerald-700' }} flex items-center justify-center text-white font-bold text-lg shadow-sm ring-2 ring-white">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                        @if(auth()->user()->role === 'seller')
                                            <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 text-[10px] font-bold uppercase bg-green-100 text-green-800 rounded-full">🏪 Seller</span>
                                        @else
                                            <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold uppercase bg-green-100 text-green-700 rounded-full">Customer</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->role === 'seller')
                                <div class="p-2 border-b border-gray-100">
                                    <a href="{{ route('seller.dashboard') }}"
                                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-green-600 to-emerald-700 text-white font-bold text-sm shadow-sm transition hover:from-green-700 hover:to-emerald-800">
                                        <span class="flex items-center gap-2"><span>🏪</span><span>Go to Seller Dashboard</span></span>
                                        <span>→</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('seller.products.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium">
                                        <span>🛒</span><span>Manage Products</span>
                                    </a>
                                    <a href="{{ route('seller.orders.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium">
                                        <span>📦</span><span>Customer Orders</span>
                                    </a>
                                    <a href="{{ route('seller.earnings') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium">
                                        <span>💰</span><span>Earnings & Sales</span>
                                    </a>
                                </div>
                            @else
                                <div class="p-2 border-b border-gray-100">
                                    <a href="{{ url('/dashboard') }}"
                                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gradient-to-r from-green-600 to-emerald-700 text-white font-semibold text-sm shadow-sm hover:from-green-700 hover:to-emerald-800 transition">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                            <span>My Dashboard</span>
                                        </span>
                                        <span>→</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <a href="{{ url('/dashboard#orders') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium">
                                        <span>📦</span><span>My Orders</span>
                                    </a>
                                    <a href="{{ url('/dashboard#account') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition font-medium">
                                        <span>👤</span><span>My Account</span>
                                    </a>
                                </div>
                            @endif

                            <div class="border-t border-gray-100 pt-1">
                                <form action="{{ auth()->user()->role === 'seller' ? route('seller.logout') : url('/logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition text-left">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
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
            <a href="#" class="relative flex items-center gap-1.5 text-gray-700 hover:text-green-700 font-semibold transition shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="hidden sm:inline text-sm font-bold">Cart</span>
                <span class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[10px] font-bold w-4.5 h-4.5 rounded-full flex items-center justify-center" style="width:18px;height:18px;font-size:10px;">0</span>
            </a>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="main-nav-bar text-white" style="background: linear-gradient(135deg, #064e3b 0%, #047857 50%, #065f46 100%) !important; display: block !important;">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="flex items-center justify-between h-12">

                <!-- Primary Nav Links -->
                <div class="flex items-center gap-1.5 overflow-x-auto scrollbar-none py-1">
                    <a href="{{ route('home') }}"
                       class="nav-link-btn {{ request()->routeIs('home') ? 'active' : '' }}"
                       style="{{ request()->routeIs('home') ? 'background: rgba(255,255,255,0.25) !important;' : '' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('products') }}"
                       class="nav-link-btn {{ request()->routeIs('products') ? 'active' : '' }}"
                       style="{{ request()->routeIs('products') ? 'background: rgba(255,255,255,0.25) !important;' : '' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('about') }}"
                       class="nav-link-btn {{ request()->routeIs('about') ? 'active' : '' }}"
                       style="{{ request()->routeIs('about') ? 'background: rgba(255,255,255,0.25) !important;' : '' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>About Us</span>
                    </a>
                    <a href="{{ route('contact') }}"
                       class="nav-link-btn {{ request()->routeIs('contact') ? 'active' : '' }}"
                       style="{{ request()->routeIs('contact') ? 'background: rgba(255,255,255,0.25) !important;' : '' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Contact</span>
                    </a>
                </div>

                <!-- Quick Category Shortcuts -->
                <div class="hidden lg:flex items-center gap-3 text-xs font-semibold text-emerald-100">
                    <a href="{{ route('products') }}?category=fruits-vegetables" class="hover:text-white transition">Fruits & Veggies</a>
                    <span class="opacity-30">|</span>
                    <a href="{{ route('products') }}?category=dairy-eggs-bakery" class="hover:text-white transition">Dairy & Eggs</a>
                    <span class="opacity-30">|</span>
                    <a href="{{ route('products') }}?category=grains-rice-pulses" class="hover:text-white transition">Grains & Pulses</a>
                    <span class="opacity-30">|</span>
                    <a href="{{ route('products') }}?category=snacks-beverages" class="hover:text-white transition">Snacks</a>
                </div>

            </div>
        </div>
    </nav>
</header>




<!-- Flash Messages -->
@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 lg:px-6 pt-4">
        <div id="flashSuccessAlert" class="flex items-center justify-between bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3.5 rounded-xl shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold text-sm md:text-base">{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('flashSuccessAlert').remove()" class="text-white/80 hover:text-white text-xl font-bold p-1">&times;</button>
        </div>
    </div>
@endif


<!-- =========================================================
     HERO SECTION
========================================================== -->
<section class="hero">
    <div class="max-w-7xl mx-auto px-6 py-14 md:py-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <!-- Hero Text -->
            <div class="text-white">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/15 backdrop-blur-sm rounded-full text-xs font-bold text-green-200 mb-4 border border-white/20">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Daily Fresh Delivery Available
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight">
                    Farm-Fresh Grocery
                    <span class="text-green-300">Delivered Daily</span>
                    to Your Door 🌿
                </h1>

                <p class="mt-5 text-base md:text-lg text-green-100 max-w-xl leading-relaxed">
                    Order fresh fruits, vegetables, dairy, grains and daily essentials from verified local farmers and trusted brands.
                    <strong class="text-white">Free delivery above ₹499.</strong>
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('products') }}"
                       class="inline-flex items-center gap-2 bg-white text-green-700 px-7 py-3.5 rounded-xl font-black hover:bg-green-50 transition shadow-lg text-base">
                        🛒 Shop Now
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 border-2 border-white/60 text-white px-7 py-3.5 rounded-xl font-bold hover:bg-white/10 transition text-base">
                        Get Started Free
                    </a>
                </div>

                <!-- Trust Tags -->
                <div class="mt-8 flex flex-wrap items-center gap-4 text-sm text-green-200">
                    <span class="flex items-center gap-1.5">✅ 100% Fresh Produce</span>
                    <span class="flex items-center gap-1.5">⏱️ 2-Hour Delivery</span>
                    <span class="flex items-center gap-1.5">🔒 Safe & Secure Payments</span>
                </div>
            </div>

            <!-- Hero Visual Card -->
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <!-- Quick Order Sections -->
                    <p class="text-white font-bold text-sm mb-4 flex items-center gap-2">⚡ Quick 15-Min Reorder</p>
                    <div class="space-y-3">
                        @php
                            $heroProducts = App\Models\Product::where('is_featured', true)->where('is_active', true)->with('category')->take(4)->get();
                        @endphp
                        @forelse($heroProducts as $hp)
                        <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 hover:bg-white/15 transition">
                            <div class="w-12 h-12 bg-white/20 rounded-xl overflow-hidden flex items-center justify-center text-xl shrink-0">
                                @if($hp->image_url ?? $hp->featured_image)
                                    <img src="{{ $hp->image_url ?? $hp->featured_image }}" alt="{{ $hp->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ $hp->category->icon ?? '🥬' }}
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-semibold text-sm truncate">{{ $hp->name }}</p>
                                <p class="text-green-200 text-xs">{{ $hp->category->name ?? 'Fresh Produce' }}</p>
                            </div>
                            <span class="text-white font-black text-sm shrink-0">₹{{ number_format($hp->price) }}</span>
                        </div>
                        @empty
                        <div class="text-green-200 text-sm text-center py-4">Fresh products loading…</div>
                        @endforelse
                    </div>
                    <a href="{{ route('products') }}" class="mt-4 block w-full text-center bg-white text-green-700 font-bold py-2.5 rounded-xl text-sm hover:bg-green-50 transition">
                        View All Products →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================
     PROMO BANNERS
========================================================== -->
<section class="max-w-7xl mx-auto px-6 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="promo-green rounded-2xl p-5 text-white flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl shrink-0">🥬</div>
            <div>
                <p class="font-black text-lg leading-tight">Fresh Veggies</p>
                <p class="text-green-200 text-sm">Up to 30% off today</p>
                <a href="{{ route('products') }}?category=fruits-vegetables" class="mt-2 inline-block text-xs font-bold bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition">Shop Now →</a>
            </div>
        </div>

        <div class="promo-orange rounded-2xl p-5 text-white flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl shrink-0">🥛</div>
            <div>
                <p class="font-black text-lg leading-tight">Dairy & Eggs</p>
                <p class="text-orange-100 text-sm">Farm fresh every morning</p>
                <a href="{{ route('products') }}?category=dairy-eggs-bakery" class="mt-2 inline-block text-xs font-bold bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition">Shop Now →</a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-amber-600 rounded-2xl p-5 text-white flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl shrink-0">🌾</div>
            <div>
                <p class="font-black text-lg leading-tight">Grains & Pulses</p>
                <p class="text-yellow-100 text-sm">Best prices guaranteed</p>
                <a href="{{ route('products') }}?category=grains-rice-pulses" class="mt-2 inline-block text-xs font-bold bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition">Shop Now →</a>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================
     SHOP BY CATEGORY
========================================================== -->
<section class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex items-center justify-between mb-7">
        <div>
            <p class="section-label">Browse</p>
            <h2 class="text-3xl font-black text-slate-900 mt-1">Shop by Category</h2>
        </div>
        <a href="{{ route('products') }}" class="text-green-600 font-bold hover:text-green-800 transition text-sm">View All →</a>
    </div>

    @php
        $categories = App\Models\Category::where('is_active', 1)->get();
        $catColors = [
            0 => ['bg' => 'bg-green-50',   'icon_bg' => 'bg-green-100',   'text' => 'text-green-700',  'hover' => 'group-hover:bg-green-600'],
            1 => ['bg' => 'bg-blue-50',    'icon_bg' => 'bg-blue-100',    'text' => 'text-blue-700',   'hover' => 'group-hover:bg-blue-600'],
            2 => ['bg' => 'bg-amber-50',   'icon_bg' => 'bg-amber-100',   'text' => 'text-amber-700',  'hover' => 'group-hover:bg-amber-600'],
            3 => ['bg' => 'bg-purple-50',  'icon_bg' => 'bg-purple-100',  'text' => 'text-purple-700', 'hover' => 'group-hover:bg-purple-600'],
            4 => ['bg' => 'bg-red-50',     'icon_bg' => 'bg-red-100',     'text' => 'text-red-700',    'hover' => 'group-hover:bg-red-600'],
            5 => ['bg' => 'bg-cyan-50',    'icon_bg' => 'bg-cyan-100',    'text' => 'text-cyan-700',   'hover' => 'group-hover:bg-cyan-600'],
            6 => ['bg' => 'bg-pink-50',    'icon_bg' => 'bg-pink-100',    'text' => 'text-pink-700',   'hover' => 'group-hover:bg-pink-600'],
            7 => ['bg' => 'bg-teal-50',    'icon_bg' => 'bg-teal-100',    'text' => 'text-teal-700',   'hover' => 'group-hover:bg-teal-600'],
        ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($categories as $i => $cat)
        @php $clr = $catColors[$i % 8]; @endphp
        <a href="{{ route('products') }}?category={{ $cat->slug }}"
           class="cat-card group p-5 text-center hover:shadow-lg hover:-translate-y-1 transition">
            <div class="w-14 h-14 mx-auto rounded-2xl {{ $clr['icon_bg'] }} {{ $clr['text'] }} {{ $clr['hover'] }} group-hover:text-white flex items-center justify-center text-2xl transition-all duration-300 shadow-sm">
                {{ $cat->icon }}
            </div>
            <h3 class="font-bold text-sm mt-3 text-slate-800 group-hover:text-green-700 transition leading-tight">
                {{ $cat->name }}
            </h3>
            @php $cnt = App\Models\Product::where('category_id', $cat->id)->where('is_active', true)->count(); @endphp
            <p class="text-xs text-slate-500 mt-1">{{ $cnt }} items</p>
        </a>
        @endforeach
    </div>
</section>


<!-- =========================================================
     FEATURED PRODUCTS (from DB)
========================================================== -->
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="section-label">Fresh & Handpicked</p>
                <h2 class="text-3xl font-black text-slate-900 mt-1">Featured Daily Groceries</h2>
            </div>
            <a href="{{ route('products') }}" class="text-green-600 font-bold hover:text-green-800 transition text-sm">View All →</a>
        </div>

        @php
            $featuredProducts = App\Models\Product::where('is_featured', true)->where('is_active', true)->with(['category', 'variations'])->take(8)->get();
            $emojiMap = ['fruits-vegetables'=>'🥦','dairy-eggs-bakery'=>'🥛','grains-rice-pulses'=>'🌾','snacks-beverages'=>'🧃','spices-oil-masalas'=>'🌶️','frozen-instant-foods'=>'🍱','personal-care-hygiene'=>'🧴','organic-health-foods'=>'🌿'];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($featuredProducts as $idx => $product)
            @php
                $catSlug = $product->category->slug ?? '';
                $emoji   = $emojiMap[$catSlug] ?? '🛒';
                $disc    = $product->discount_percentage;
                $imgUrl  = $product->image_url ?? $product->featured_image;
            @endphp
            <div class="prod-card group flex flex-col justify-between">
                <!-- Image Area -->
                <a href="{{ route('products.show', $product->slug) }}" class="block">
                    <div class="h-48 bg-emerald-50/50 flex items-center justify-center relative overflow-hidden">
                        @if($disc > 0)
                            <span class="badge badge-offer absolute top-2.5 left-2.5 shadow-sm">{{ $disc }}% OFF</span>
                        @else
                            <span class="badge badge-fresh absolute top-2.5 left-2.5 shadow-sm">🌿 FRESH</span>
                        @endif
                        @if($imgUrl)
                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <span class="text-5xl group-hover:scale-110 transition duration-300">{{ $emoji }}</span>
                        @endif
                    </div>
                </a>
                <!-- Info -->
                <div class="p-4 flex flex-col flex-1 justify-between">
                    <div>
                        <p class="text-xs text-green-600 font-semibold">{{ $product->category->name ?? 'Grocery' }}</p>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <h3 class="font-bold text-sm mt-0.5 text-slate-800 hover:text-green-700 transition leading-snug line-clamp-2">{{ $product->name }}</h3>
                        </a>
                        <p class="text-xs text-slate-400 mt-1">{{ $product->variations->first()->name ?? ($product->category->name ?? '1 Pack') }}</p>
                        <!-- Stars -->
                        <div class="flex items-center gap-1 mt-2">
                            <div class="flex text-amber-400">
                                @for($i=0;$i<5;$i++)<svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                            </div>
                            <span class="text-xs text-slate-400">({{ rand(40,240) }})</span>
                        </div>
                    </div>
                    <!-- Price + Add -->
                    <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                        <div>
                            <span class="text-lg font-black text-slate-900">₹{{ number_format($product->price) }}</span>
                            @if($product->compare_at_price > $product->price)
                                <span class="text-xs text-slate-400 line-through ml-1">₹{{ number_format($product->compare_at_price) }}</span>
                            @endif
                        </div>
                        <button class="add-btn" onclick="this.textContent='✓ Added'; this.style.background='linear-gradient(135deg,#059669,#047857)'; setTimeout(()=>{this.innerHTML='+ Add';this.style.background='';},1500);">
                            + Add
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-10 text-slate-400">No featured products found.</div>
            @endforelse
        </div>
    </div>
</section>


<!-- =========================================================
     ALL PRODUCTS BY CATEGORY STRIP
========================================================== -->
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-7">
        <div>
            <p class="section-label">Pantry & Daily Essentials</p>
            <h2 class="text-3xl font-black text-slate-900 mt-1">Popular Grocery Items</h2>
        </div>
        <a href="{{ route('products') }}" class="text-green-600 font-bold hover:text-green-800 transition text-sm">View All →</a>
    </div>

    @php
        $popularProducts = App\Models\Product::where('is_active', true)->with(['category', 'variations'])->latest()->take(6)->get();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($popularProducts as $idx => $product)
        @php
            $catSlug = $product->category->slug ?? '';
            $emoji   = $emojiMap[$catSlug] ?? '🛒';
            $disc    = $product->discount_percentage;
            $imgUrl  = $product->image_url ?? $product->featured_image;
        @endphp
        <a href="{{ route('products.show', $product->slug) }}"
           class="bg-white border border-green-100 rounded-2xl p-4 flex items-center gap-4 hover:shadow-lg hover:border-green-300 transition group">
            <div class="w-18 h-18 rounded-xl bg-green-50 overflow-hidden flex items-center justify-center text-3xl shrink-0 group-hover:scale-105 transition" style="width:72px;height:72px;">
                @if($imgUrl)
                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    {{ $emoji }}
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-green-600 font-semibold">{{ $product->category->name ?? '' }}</p>
                <h3 class="font-bold text-sm text-slate-800 group-hover:text-green-700 transition leading-snug truncate">{{ $product->name }}</h3>
                <p class="text-xs text-slate-400 mt-0.5">{{ $product->variations->first()->name ?? ($product->category->name ?? 'Standard Pack') }}</p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="font-black text-green-700 text-base">₹{{ number_format($product->price) }}</span>
                    @if($product->compare_at_price > $product->price)
                        <span class="text-xs text-slate-400 line-through">₹{{ number_format($product->compare_at_price) }}</span>
                    @endif
                    @if($disc > 0)
                        <span class="badge badge-offer">{{ $disc }}% OFF</span>
                    @endif
                </div>
            </div>
            <button onclick="event.preventDefault(); this.textContent='✓'; this.style.background='#059669';" class="add-btn shrink-0 text-xs px-3 py-2">+ Add</button>
        </a>
        @endforeach
    </div>
</section>




<!-- =========================================================
     WHY SHOP WITH US
========================================================== -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="section-label">Our Promise</p>
            <h2 class="text-3xl font-black text-slate-900 mt-2">Why Choose FreshBasket?</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $features = [
                    ['icon'=>'🌿','color'=>'bg-green-50 text-green-600','title'=>'100% Fresh','desc'=>'Sourced directly from verified farms and trusted suppliers.'],
                    ['icon'=>'⚡','color'=>'bg-amber-50 text-amber-600','title'=>'Fast Delivery','desc'=>'Same-day & next-day delivery across 500+ cities in India.'],
                    ['icon'=>'💰','color'=>'bg-blue-50 text-blue-600','title'=>'Best Prices','desc'=>'Guaranteed lowest prices with daily deals and offers.'],
                    ['icon'=>'🔒','color'=>'bg-purple-50 text-purple-600','title'=>'Safe & Secure','desc'=>'100% secure payments with refund guarantee on every order.'],
                ];
            @endphp
            @foreach($features as $f)
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto rounded-2xl {{ $f['color'] }} flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 transition">
                    {{ $f['icon'] }}
                </div>
                <h3 class="font-bold text-base mt-4 text-slate-900">{{ $f['title'] }}</h3>
                <p class="text-slate-500 mt-2 text-xs leading-5">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>





<!-- =========================================================
     FOOTER
========================================================== -->
<footer class="footer-main text-gray-400">
    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-green-600 rounded-xl flex items-center justify-center text-white font-black text-base">🛒</div>
                    <h3 class="text-xl font-black text-white">FreshBasket</h3>
                </div>
                <p class="text-sm leading-6">India's most trusted online grocery store. Farm-fresh produce and daily essentials delivered to your doorstep every day.</p>
                <div class="flex gap-3 mt-5">
                    <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center text-xs hover:bg-green-600 transition cursor-pointer">f</div>
                    <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center text-xs hover:bg-green-600 transition cursor-pointer">in</div>
                    <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center text-xs hover:bg-green-600 transition cursor-pointer">tw</div>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-bold mb-4">Quick Links</h4>
                <div class="space-y-2.5 text-sm">
                    <a href="{{ route('home') }}" class="block hover:text-white hover:pl-1 transition">🏠 Home</a>
                    <a href="{{ route('products') }}" class="block hover:text-white hover:pl-1 transition">🛒 Products</a>
                    <a href="{{ route('about') }}" class="block hover:text-white hover:pl-1 transition">ℹ️ About Us</a>
                    <a href="{{ route('contact') }}" class="block hover:text-white hover:pl-1 transition">📞 Contact</a>
                </div>
            </div>

            <!-- Categories -->
            <div>
                <h4 class="text-white font-bold mb-4">Categories</h4>
                <div class="space-y-2.5 text-sm">
                    <a href="{{ route('products') }}?category=fruits-vegetables" class="block hover:text-white hover:pl-1 transition">🥦 Fruits & Vegetables</a>
                    <a href="{{ route('products') }}?category=dairy-eggs-bakery" class="block hover:text-white hover:pl-1 transition">🥛 Dairy & Eggs</a>
                    <a href="{{ route('products') }}?category=grains-rice-pulses" class="block hover:text-white hover:pl-1 transition">🌾 Grains & Pulses</a>
                    <a href="{{ route('products') }}?category=snacks-beverages" class="block hover:text-white hover:pl-1 transition">🧃 Snacks & Drinks</a>
                    <a href="{{ route('products') }}?category=spices-oil-masalas" class="block hover:text-white hover:pl-1 transition">🌶️ Spices & Masalas</a>
                </div>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-bold mb-4">Contact Us</h4>
                <div class="space-y-3 text-sm">
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        support@freshbasket.in
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        1800-123-FRESH (37374)
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        FreshBasket HQ, Bengaluru, India
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
            <p>© {{ date('Y') }} FreshBasket. All rights reserved.</p>
            <div class="flex gap-5">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
                <a href="#" class="hover:text-white transition">Refund Policy</a>
            </div>
        </div>
    </div>
</footer>


<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('profileDropdownBtn');
        const menu = document.getElementById('profileDropdownMenu');
        const chevron = document.getElementById('profileChevron');
        const wrapper = document.getElementById('profileDropdownWrapper');

        if (btn && menu) {
            function openMenu() {
                menu.classList.remove('hidden');
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
                setTimeout(() => { if (btn.getAttribute('aria-expanded') === 'false') menu.classList.add('hidden'); }, 150);
            }
            btn.addEventListener('click', e => { e.stopPropagation(); btn.getAttribute('aria-expanded') === 'true' ? closeMenu() : openMenu(); });
            document.addEventListener('click', e => { if (wrapper && !wrapper.contains(e.target)) closeMenu(); });
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
        }

        const flash = document.getElementById('flashSuccessAlert');
        if (flash) {
            setTimeout(() => { flash.style.opacity='0'; flash.style.transform='translateY(-10px)'; setTimeout(()=>flash.remove(), 300); }, 7000);
        }
    });
</script>

</body>
</html>
