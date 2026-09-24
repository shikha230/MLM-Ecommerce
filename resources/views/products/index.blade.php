<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $selectedCategory ? $selectedCategory->name . ' - ' : '' }}Products - FreshBasket</title>
    <meta name="description" content="Browse our wide selection of products across electronics, fashion, home essentials, wellness and more on FreshBasket.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-['Inter',sans-serif] min-h-screen flex flex-col">

    {{-- =========================================================
         TOP NAVBAR
    ========================================================== --}}
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-20 flex items-center justify-between gap-4">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="shrink-0 flex items-center gap-2">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-2xl md:text-3xl font-extrabold text-green-600">
                        FreshBasket
                    </span>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4 hidden md:block">
                    <form action="{{ route('products') }}" method="GET" class="flex">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search products, brands, categories..."
                            class="w-full h-11 px-4 border border-gray-300 rounded-l-xl focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 text-sm"
                        >
                        <button
                            type="submit"
                            aria-label="Search"
                            class="h-11 px-5 bg-green-600 text-white rounded-r-xl hover:bg-green-700 transition flex items-center justify-center shrink-0"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Navigation Links & User Menu -->
                <div class="flex items-center gap-4 sm:gap-6">
                    <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-gray-700">
                        <a href="{{ route('home') }}" class="hover:text-green-600 transition">Home</a>
                        <a href="{{ route('products') }}" class="text-green-600 font-semibold">Products</a>
                        <a href="{{ route('about') }}" class="hover:text-green-600 transition">About Us</a>
                        <a href="{{ route('contact') }}" class="hover:text-green-600 transition">Contact</a>
                    </div>

                    @guest
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition shadow-sm">
                                Register
                            </a>
                        </div>
                    @else
                        <!-- Profile Dropdown -->
                        <div class="relative" id="profileDropdownWrapper">
                            <button type="button"
                                    id="profileDropdownBtn"
                                    class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 transition border border-transparent hover:border-gray-200 focus:outline-none">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-green-600 to-emerald-700 flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-white">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden sm:inline text-sm font-semibold text-gray-800">
                                    {{ Str::limit(auth()->user()->name, 12) }}
                                </span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Menu -->
                            <div id="profileDropdownMenu"
                                 class="hidden absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 py-2">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/70 rounded-t-xl">
                                    <p class="text-xs text-gray-400">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                </div>
                                @if(auth()->user()->role === 'seller')
                                    <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 transition">
                                        <span>🏪</span>
                                        <span>Seller Dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 font-medium transition">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                @endif
                                <form action="/logout" method="POST" class="m-0 border-t border-gray-100 mt-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition text-left">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Cart Link -->
                    <a href="#" class="relative flex items-center gap-1.5 text-gray-700 hover:text-green-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- Mobile Search Bar (visible on small screens) -->
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('products') }}" method="GET" class="flex">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="w-full h-10 px-4 border border-gray-300 rounded-l-xl focus:outline-none focus:border-green-500 text-sm"
                >
                <button
                    type="submit"
                    aria-label="Search"
                    class="h-10 px-4 bg-green-600 text-white rounded-r-xl flex items-center justify-center"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </header>


    {{-- =========================================================
         PAGE HERO BANNER
    ========================================================== --}}
    <section class="bg-gradient-to-r from-emerald-800 via-green-700 to-teal-800 text-white py-12 shadow-lg relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-9xl select-none pointer-events-none">🥦</div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-green-200 mb-2 font-medium">
                        <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                        <span>/</span>
                        <a href="{{ route('products') }}" class="hover:text-white transition">Fresh Groceries</a>
                        @if($selectedCategory)
                            <span>/</span>
                            <span class="text-white">{{ $selectedCategory->name }}</span>
                        @endif
                    </nav>

                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                        @if($selectedCategory)
                            {{ $selectedCategory->icon ?? '🛒' }} {{ $selectedCategory->name }}
                        @elseif(request('search'))
                            Search results for "{{ request('search') }}"
                        @else
                            🌿 All Fresh Grocery Products
                        @endif
                    </h1>

                    <p class="text-green-100 text-sm md:text-base mt-2 max-w-2xl">
                        @if($selectedCategory && $selectedCategory->description)
                            {{ $selectedCategory->description }}
                        @else
                            Farm-fresh fruits, leafy greens, pure dairy, unpolished dals, cold-pressed oils, and pantry staples delivered directly to your doorstep.
                        @endif
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <span class="px-4 py-2 rounded-xl bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-bold tracking-wide uppercase text-green-100 shadow-sm">
                        🌿 {{ $products->total() }} Fresh {{ Str::plural('Item', $products->total()) }} Available
                    </span>
                </div>
            </div>
        </div>
    </section>


    {{-- =========================================================
         MAIN CONTENT: FILTERS + PRODUCT GRID
    ========================================================== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

            {{-- ==================== LEFT FILTER SIDEBAR ==================== --}}
            <aside class="lg:col-span-1 space-y-6">

                <!-- Filter Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-green-100">

                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-5">
                        <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Grocery Filters
                        </h3>

                        @if(request('category') || request('search') || request('min_price') || request('max_price') || request('in_stock'))
                            <a href="{{ route('products') }}" class="text-xs text-green-600 hover:text-green-800 font-bold transition">
                                Reset All
                            </a>
                        @endif
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-6">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                            Aisles & Categories
                        </h4>

                        <div class="space-y-1.5">
                            <!-- All Categories Option -->
                            <a href="{{ route('products', array_filter(request()->except(['category', 'page']))) }}"
                               class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ !request('category') ? 'bg-gradient-to-r from-emerald-700 to-green-600 text-white shadow-sm' : 'text-gray-700 hover:bg-green-50' }}">
                                <span class="flex items-center gap-2"><span>🛒</span><span>All Items</span></span>
                                <span class="text-xs px-2 py-0.5 rounded-full {{ !request('category') ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $totalActiveProducts }}
                                </span>
                            </a>

                            @foreach($categories as $cat)
                                @php
                                    $isActive = request('category') == $cat->slug || request('category') == $cat->id;
                                @endphp
                                <a href="{{ route('products', array_merge(request()->except(['page']), ['category' => $cat->slug])) }}"
                                   class="flex items-center justify-between px-3.5 py-2 rounded-xl text-sm font-semibold transition {{ $isActive ? 'bg-gradient-to-r from-emerald-700 to-green-600 text-white shadow-sm' : 'text-gray-700 hover:bg-green-50' }}">
                                    <span class="truncate flex items-center gap-2">
                                        <span>{{ $cat->icon ?? '🌱' }}</span>
                                        <span>{{ $cat->name }}</span>
                                    </span>
                                    <span class="text-xs px-2 py-0.5 rounded-full {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $cat->products_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Filter Form -->
                    <div class="pt-5 border-t border-gray-100">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                            Budget Range (₹)
                        </h4>

                        <form action="{{ route('products') }}" method="GET" class="space-y-3">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif

                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-[11px] text-gray-500 block mb-1">Min (₹)</label>
                                    <input
                                        type="number"
                                        name="min_price"
                                        min="0"
                                        placeholder="0"
                                        value="{{ request('min_price') }}"
                                        class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-green-500"
                                    >
                                </div>
                                <div>
                                    <label class="text-[11px] text-gray-500 block mb-1">Max (₹)</label>
                                    <input
                                        type="number"
                                        name="max_price"
                                        min="0"
                                        placeholder="1000"
                                        value="{{ request('max_price') }}"
                                        class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-green-500"
                                    >
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="w-full py-2.5 bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs rounded-xl shadow-sm transition"
                            >
                                Apply Price
                            </button>
                        </form>
                    </div>
                            </button>
                        </form>
                    </div>

                    <!-- In Stock Checkbox -->
                    <div class="pt-5 border-t border-gray-100">
                        <form action="{{ route('products') }}" method="GET" id="stockFilterForm">
                            @foreach(request()->except(['in_stock', 'page']) as $k => $v)
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                            @endforeach
                            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 font-medium select-none">
                                <input
                                    type="checkbox"
                                    name="in_stock"
                                    value="1"
                                    {{ request('in_stock') ? 'checked' : '' }}
                                    onchange="document.getElementById('stockFilterForm').submit()"
                                    class="w-4 h-4 text-green-600 rounded border-gray-300 focus:ring-green-500"
                                >
                                <span>In Stock Only</span>
                            </label>
                        </form>
                    </div>

                </div>

            </aside>


            {{-- ==================== RIGHT PRODUCTS GRID ==================== --}}
            <section class="lg:col-span-3">

                <!-- Top Sort & Controls Bar -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-200/80 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <!-- Results Counter & Active Pills -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-semibold text-gray-700">
                            Showing <span class="text-green-600 font-bold">{{ $products->count() }}</span> of {{ $products->total() }} results
                        </span>

                        @if(request('category') && $selectedCategory)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span>{{ $selectedCategory->name }}</span>
                                <a href="{{ route('products', array_filter(request()->except(['category', 'page']))) }}" class="hover:text-emerald-950 font-bold">&times;</a>
                            </span>
                        @endif

                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span>"{{ request('search') }}"</span>
                                <a href="{{ route('products', array_filter(request()->except(['search', 'page']))) }}" class="hover:text-emerald-950 font-bold">&times;</a>
                            </span>
                        @endif

                        @if(request('min_price') || request('max_price'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <span>₹{{ request('min_price', 0) }} - ₹{{ request('max_price', 'Any') }}</span>
                                <a href="{{ route('products', array_filter(request()->except(['min_price', 'max_price', 'page']))) }}" class="hover:text-emerald-950 font-bold">&times;</a>
                            </span>
                        @endif
                    </div>

                    <!-- Sort Form -->
                    <form action="{{ route('products') }}" method="GET" class="flex items-center gap-2">
                        @foreach(request()->except(['sort', 'page']) as $k => $v)
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endforeach

                        <label for="sortSelect" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Sort By:</label>
                        <select
                            id="sortSelect"
                            name="sort"
                            onchange="this.form.submit()"
                            class="text-sm font-medium border border-gray-300 rounded-xl px-3 py-1.5 bg-white text-gray-700 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                        >
                            <option value="featured"   {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                            <option value="newest"     {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_low"  {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc"   {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                        </select>
                    </form>

                </div>


                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach($products as $product)
                            @php
                                $imgSrc = $product->image_url ?? $product->featured_image;
                            @endphp
                            <div class="group bg-white rounded-2xl border border-gray-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-250 flex flex-col overflow-hidden">

                                <!-- Product Image Area -->
                                <div class="relative h-56 bg-emerald-50/50 flex items-center justify-center overflow-hidden">

                                    @if($imgSrc)
                                        <img
                                            src="{{ $imgSrc }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80';"
                                        >
                                    @else
                                        <!-- Fallback Vector Icon Container -->
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100/70 text-emerald-600">
                                            <span class="text-6xl">{{ $product->category->icon ?? '🛒' }}</span>
                                            <span class="text-xs text-emerald-800 font-semibold mt-2">{{ $product->category->name ?? 'Grocery' }}</span>
                                        </div>
                                    @endif

                                    <!-- Badges -->
                                    <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                                        @if($product->is_featured)
                                            <span class="px-2.5 py-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-[10px] font-extrabold rounded-lg shadow-sm">
                                                🌿 FRESH PICK
                                            </span>
                                        @endif

                                        @if($product->discount_percentage > 0)
                                            <span class="px-2.5 py-1 bg-gradient-to-r from-amber-500 to-emerald-600 text-white text-[10px] font-extrabold rounded-lg shadow-sm">
                                                {{ $product->discount_percentage }}% OFF
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Stock Status Badge -->
                                    <div class="absolute top-3 right-3">
                                        @if($product->stock > 5)
                                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full border border-emerald-200">
                                                In Stock
                                            </span>
                                        @elseif($product->stock > 0)
                                            <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-full border border-amber-200">
                                                Only {{ $product->stock }} left
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 bg-red-50 text-red-700 text-[10px] font-bold rounded-full border border-red-200">
                                                Out of Stock
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <!-- Product Info Area -->
                                <div class="p-5 flex-1 flex flex-col justify-between">

                                    <div>
                                        <!-- Category -->
                                        @if($product->category)
                                            <a href="{{ route('products', ['category' => $product->category->slug]) }}"
                                               class="text-xs font-semibold text-green-600 hover:text-green-800 transition tracking-wide uppercase">
                                                {{ $product->category->name }}
                                            </a>
                                        @endif

                                        <!-- Title -->
                                        <h3 class="font-bold text-gray-900 text-base mt-1 line-clamp-2 group-hover:text-green-600 transition">
                                            {{ $product->name }}
                                        </h3>

                                        <!-- Seller Store Info -->
                                        @if($product->seller)
                                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <span>Sold by: <strong class="text-gray-600">{{ $product->seller->store_name }}</strong></span>
                                            </p>
                                        @endif

                                        <!-- Short Description -->
                                        @if($product->short_description)
                                            <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">
                                                {{ $product->short_description }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Price and Actions -->
                                    <div class="mt-4 pt-3 border-t border-gray-100">

                                        <div class="flex items-baseline gap-2 mb-3">
                                            <span class="text-2xl font-extrabold text-gray-900">
                                                ₹{{ number_format($product->price, 2) }}
                                            </span>
                                            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                                                <span class="text-sm text-gray-400 line-through">
                                                    ₹{{ number_format($product->compare_at_price, 2) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <a
                                                href="{{ route('products.show', $product->slug) }}"
                                                class="px-3 py-2.5 rounded-xl border border-green-200 text-green-700 hover:bg-green-50 font-bold text-xs transition"
                                            >
                                                Details
                                            </a>
                                            <button
                                                type="button"
                                                onclick="this.textContent='✓ Added'; this.style.background='linear-gradient(135deg,#059669,#047857)'; setTimeout(()=>{this.innerHTML='<span>🛒</span><span>Add to Basket</span>'; this.style.background='';},1400);"
                                                class="flex-1 py-2.5 px-4 bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs rounded-xl transition flex items-center justify-center gap-2 shadow-sm"
                                            >
                                                <span>🛒</span>
                                                <span>Add to Basket</span>
                                            </button>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>

                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-3xl p-12 text-center border border-green-100 shadow-sm max-w-lg mx-auto my-6">
                        <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center text-emerald-600 mx-auto mb-5 text-4xl">
                            🥬
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            No Fresh Items Found
                        </h3>

                        <p class="text-sm text-gray-500 mb-6 max-w-md mx-auto leading-relaxed">
                            We couldn't find any grocery items matching your selected criteria. Try checking another aisle or clearing your filters.
                        </p>

                        <div class="flex justify-center gap-3">
                            <a href="{{ route('products') }}"
                               class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-green-600 text-white font-bold text-sm rounded-xl shadow-sm hover:from-emerald-700 hover:to-green-700 transition">
                                Clear All Filters
                            </a>
                            <a href="{{ route('home') }}"
                               class="px-5 py-2.5 bg-gray-100 text-gray-700 font-semibold text-sm rounded-xl hover:bg-gray-200 transition">
                                Back to Home
                            </a>
                        </div>
                    </div>
                @endif

            </section>

        </div>

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="bg-gray-900 text-gray-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 flex items-center justify-center text-white text-base">🛒</div>
                        <h3 class="text-xl font-bold text-white">FreshBasket</h3>
                    </div>
                    <p class="mt-4 text-xs leading-relaxed">
                        India's preferred farm-to-table fresh grocery store. Quality certified organic produce, dairy, and daily essentials.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Quick Links</h4>
                    <div class="space-y-2.5 text-xs">
                        <a href="{{ route('home') }}" class="block hover:text-white transition">Home</a>
                        <a href="{{ route('products') }}" class="block hover:text-white transition">Fresh Catalogue</a>
                        <a href="{{ route('about') }}" class="block hover:text-white transition">About Our Farms</a>
                        <a href="{{ route('contact') }}" class="block hover:text-white transition">Customer Care</a>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Popular Aisles</h4>
                    <div class="space-y-2.5 text-xs">
                        @foreach($categories->take(4) as $cat)
                            <a href="{{ route('products', ['category' => $cat->slug]) }}" class="block hover:text-white transition">
                                {{ $cat->icon ?? '🌿' }} {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Direct Support</h4>
                    <div class="space-y-2.5 text-xs">
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>care@freshbasket.in</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>1800-123-FRESH (37374)</span>
                        </p>
                    </div>
                </div>

            </div>

            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs">
                © {{ date('Y') }} FreshBasket. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('profileDropdownBtn');
            const menu = document.getElementById('profileDropdownMenu');
            const wrapper = document.getElementById('profileDropdownWrapper');

            if (btn && menu) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (e) {
                    if (wrapper && !wrapper.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

</body>
</html>
