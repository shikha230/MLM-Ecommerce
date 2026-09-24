<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - FreshBasket</title>
    <meta name="description" content="{{ Str::limit(strip_tags($product->short_description ?? $product->description), 150) }}">

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
                        <input
                            type="text"
                            name="search"
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
                        <a href="{{ auth()->user()->role === 'seller' ? route('seller.dashboard') : url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-green-600 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-emerald-600' : 'bg-gradient-to-tr from-green-600 to-emerald-700' }} flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            @if(auth()->user()->role === 'seller')
                                <span class="hidden md:inline text-[10px] bg-amber-100 text-amber-800 font-bold px-1.5 py-0.5 rounded">Seller</span>
                            @endif
                        </a>
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
    </header>


    {{-- =========================================================
         BREADCRUMBS
    ========================================================== --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex items-center gap-2 text-xs text-gray-500 font-medium">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition">Home</a>
                <span>/</span>
                <a href="{{ route('products') }}" class="hover:text-green-600 transition">Products</a>
                @if($product->category)
                    <span>/</span>
                    <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-green-600 transition">
                        {{ $product->category->name }}
                    </a>
                @endif
                <span>/</span>
                <span class="text-gray-900 truncate max-w-xs sm:max-w-md font-semibold">{{ $product->name }}</span>
            </nav>
        </div>
    </div>


    {{-- =========================================================
         PRODUCT DETAILS MAIN
    ========================================================== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-1 w-full">

        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-sm p-6 sm:p-10 mb-12">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-start">

                {{-- Left: Image Gallery --}}
                <div>
                    <!-- Main Featured Image -->
                    <div class="h-96 sm:h-[450px] bg-emerald-50/40 rounded-2xl overflow-hidden flex items-center justify-center border border-green-100 relative shadow-inner">
                        @php
                            $showImg = $product->image_url ?? $product->featured_image;
                        @endphp
                        @if($showImg)
                            <img
                                id="mainProductImage"
                                src="{{ $showImg }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover p-2 rounded-xl"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80';"
                            >
                        @else
                            <div class="flex flex-col items-center justify-center text-emerald-600">
                                <span class="text-7xl">{{ $product->category->icon ?? '🛒' }}</span>
                                <span class="text-sm font-bold text-emerald-800 mt-3">{{ $product->category->name ?? 'Farm Fresh' }}</span>
                            </div>
                        @endif

                        @if($product->discount_percentage > 0)
                            <span class="absolute top-4 left-4 px-3 py-1.5 bg-gradient-to-r from-amber-500 to-emerald-600 text-white text-xs font-extrabold rounded-xl shadow-md">
                                {{ $product->discount_percentage }}% OFF
                            </span>
                        @endif
                    </div>

                    <!-- Thumbnails if gallery exists -->
                    @if($product->images && $product->images->count() > 0)
                        <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2">
                            @if($showImg)
                                <button type="button"
                                        onclick="document.getElementById('mainProductImage').src='{{ $showImg }}'"
                                        class="w-16 h-16 rounded-xl border-2 border-green-600 overflow-hidden bg-gray-50 shrink-0 focus:outline-none">
                                    <img src="{{ $showImg }}" class="w-full h-full object-cover">
                                </button>
                            @endif

                            @foreach($product->images as $img)
                                <button type="button"
                                        onclick="document.getElementById('mainProductImage').src='{{ asset('storage/' . $img->image_path) }}'"
                                        class="w-16 h-16 rounded-xl border border-gray-200 hover:border-green-500 transition overflow-hidden bg-gray-50 shrink-0 focus:outline-none">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>


                {{-- Right: Product Details & Purchase Actions --}}
                <div class="flex flex-col justify-between">

                    <div>
                        <!-- Category & SKU -->
                        <div class="flex items-center justify-between gap-2 mb-2">
                            @if($product->category)
                                <a href="{{ route('products', ['category' => $product->category->slug]) }}"
                                   class="text-xs font-bold text-green-600 uppercase tracking-wider hover:underline">
                                    {{ $product->category->name }}
                                </a>
                            @endif

                            @if($product->sku)
                                <span class="text-xs text-gray-400 font-mono">
                                    SKU: {{ $product->sku }}
                                </span>
                            @endif
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>

                        <!-- Seller Store Info -->
                        @if($product->seller)
                            <div class="flex items-center gap-2 mt-2.5 pb-4 border-b border-gray-100">
                                <span class="text-xs text-gray-500">Sold & Shipped by:</span>
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $product->seller->store_name }}
                                </span>
                            </div>
                        @endif

                        <!-- Price Section -->
                        <div class="mt-6 flex items-baseline gap-3">
                            <span class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                                ₹{{ number_format($product->price, 2) }}
                            </span>

                            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                                <span class="text-lg text-gray-400 line-through">
                                    ₹{{ number_format($product->compare_at_price, 2) }}
                                </span>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    Save ₹{{ number_format($product->compare_at_price - $product->price, 2) }}
                                </span>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="mt-4 flex items-center gap-2">
                            @if($product->stock > 5)
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-emerald-700">In Stock (Ready to dispatch)</span>
                            @elseif($product->stock > 0)
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-xs font-bold text-amber-700">Hurry! Only {{ $product->stock }} items left in stock</span>
                            @else
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                <span class="text-xs font-bold text-red-700">Currently Out of Stock</span>
                            @endif
                        </div>

                        <!-- Short Description -->
                        @if($product->short_description)
                            <p class="text-sm text-gray-600 mt-5 leading-relaxed bg-gray-50/70 p-4 rounded-xl border border-gray-100">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <!-- Product Variations (Size, Color, etc.) if any -->
                        @if($product->variations && $product->variations->count() > 0)
                            <div class="mt-6">
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                    Available Options / Variations
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->variations as $var)
                                        <button type="button"
                                                class="px-4 py-2 text-xs font-semibold rounded-xl border border-gray-300 hover:border-green-600 hover:bg-green-50/50 transition">
                                            {{ $var->name }}
                                            @if($var->price)
                                                (₹{{ number_format($var->price, 2) }})
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Quantity Selector -->
                        <div class="mt-6 flex items-center gap-4">
                            <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden">
                                <button type="button" onclick="const q=document.getElementById('qty'); if(q.value>1)q.value--" class="px-3 py-1.5 bg-gray-50 text-gray-600 hover:bg-gray-100 font-bold">-</button>
                                <input id="qty" type="number" min="1" max="{{ $product->stock > 0 ? $product->stock : 1 }}" value="1" class="w-12 text-center text-sm font-semibold border-x border-gray-300 py-1.5 focus:outline-none">
                                <button type="button" onclick="const q=document.getElementById('qty'); q.value++" class="px-3 py-1.5 bg-gray-50 text-gray-600 hover:bg-gray-100 font-bold">+</button>
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-100 space-y-3">
                        <button
                            type="button"
                            onclick="this.textContent='✓ Added to Basket'; this.style.background='linear-gradient(135deg,#059669,#047857)'; setTimeout(()=>{this.innerHTML='<span>🛒</span><span>Add to Basket</span>'; this.style.background='';},1600);"
                            class="w-full py-4 bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-sm rounded-2xl shadow-lg shadow-emerald-700/25 transition flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Add to Basket</span>
                        </button>

                        <!-- Trust Features Row -->
                        <div class="grid grid-cols-3 gap-3 pt-4 text-center">
                            <div class="p-3 bg-emerald-50/60 border border-green-100 rounded-xl">
                                <span class="text-xl block mb-1">🌿</span>
                                <span class="text-[11px] font-bold text-emerald-800 block">100% Farm Fresh</span>
                            </div>
                            <div class="p-3 bg-emerald-50/60 border border-green-100 rounded-xl">
                                <span class="text-xl block mb-1">❄️</span>
                                <span class="text-[11px] font-bold text-emerald-800 block">Cold-Chain Preserved</span>
                            </div>
                            <div class="p-3 bg-emerald-50/60 border border-green-100 rounded-xl">
                                <span class="text-xl block mb-1">⚡</span>
                                <span class="text-[11px] font-bold text-emerald-800 block">Express 15-30 Min</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Full Description Accordion / Content -->
            @if($product->description)
                <div class="mt-12 pt-8 border-t border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span>📋</span>
                        <span>Product Details & Nutrition Benefits</span>
                    </h3>
                    <div class="prose max-w-none text-gray-700 text-sm leading-relaxed whitespace-pre-line bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                        {{ $product->description }}
                    </div>
                </div>
            @endif

        </div>


        {{-- =========================================================
             RELATED PRODUCTS
        ========================================================== --}}
        @if($relatedProducts && $relatedProducts->count() > 0)
            <div class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="text-xs font-bold text-green-600 uppercase tracking-wider">More in This Aisle</p>
                        <h2 class="text-2xl font-bold text-gray-900 mt-1">Customers Also Bought</h2>
                    </div>
                    <a href="{{ route('products', ['category' => $product->category->slug ?? '']) }}" class="text-green-600 font-bold text-sm hover:underline">
                        View All in {{ $product->category->name ?? 'Aisle' }} &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $rel)
                        @php
                            $relImg = $rel->image_url ?? $rel->featured_image;
                        @endphp
                        <div class="bg-white rounded-2xl border border-green-100 shadow-sm hover:shadow-lg transition p-4 flex flex-col justify-between">
                            <div class="h-44 bg-emerald-50/40 rounded-xl overflow-hidden flex items-center justify-center mb-3">
                                @if($relImg)
                                    <img src="{{ $relImg }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-4xl">{{ $rel->category->icon ?? '🛒' }}</span>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm line-clamp-1 mb-1">{{ $rel->name }}</h4>
                            <p class="text-emerald-700 font-extrabold text-base mb-3">₹{{ number_format($rel->price, 2) }}</p>
                            <a href="{{ route('products.show', $rel->slug) }}" class="w-full py-2.5 bg-green-50 hover:bg-gradient-to-r hover:from-emerald-600 hover:to-green-600 hover:text-white transition text-green-800 text-xs font-bold rounded-xl text-center">
                                View Item
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
                </div>
            </div>
        @endif

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="bg-gray-900 text-gray-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center text-xs">
            <p>© {{ date('Y') }} FreshBasket. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
