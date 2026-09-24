<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - ShopSphere</title>
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
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-2xl md:text-3xl font-extrabold text-indigo-600">
                        ShopSphere
                    </span>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4 hidden md:block">
                    <form action="{{ route('products') }}" method="GET" class="flex">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search products, brands, categories..."
                            class="w-full h-11 px-4 border border-gray-300 rounded-l-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 text-sm"
                        >
                        <button
                            type="submit"
                            aria-label="Search"
                            class="h-11 px-5 bg-indigo-600 text-white rounded-r-xl hover:bg-indigo-700 transition flex items-center justify-center shrink-0"
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
                        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
                        <a href="{{ route('products') }}" class="text-indigo-600 font-semibold">Products</a>
                        <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">About</a>
                        <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition">Contact</a>
                    </div>

                    @guest
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition shadow-sm">
                                Register
                            </a>
                        </div>
                    @else
                        <a href="{{ auth()->user()->role === 'seller' ? route('seller.dashboard') : url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full {{ auth()->user()->role === 'seller' ? 'bg-gradient-to-tr from-amber-500 to-indigo-600' : 'bg-gradient-to-tr from-indigo-600 to-purple-600' }} flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            @if(auth()->user()->role === 'seller')
                                <span class="hidden md:inline text-[10px] bg-amber-100 text-amber-800 font-bold px-1.5 py-0.5 rounded">Seller</span>
                            @endif
                        </a>
                    @endguest

                    <!-- Cart Link -->
                    <a href="#" class="relative flex items-center gap-1.5 text-gray-700 hover:text-indigo-600 transition">
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
                <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
                <span>/</span>
                <a href="{{ route('products') }}" class="hover:text-indigo-600 transition">Products</a>
                @if($product->category)
                    <span>/</span>
                    <a href="{{ route('products', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600 transition">
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
                    <div class="h-96 sm:h-[450px] bg-gray-50 rounded-2xl overflow-hidden flex items-center justify-center border border-gray-100 relative shadow-inner">
                        @if($product->featured_image)
                            <img
                                id="mainProductImage"
                                src="{{ asset('storage/' . $product->featured_image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-contain p-4"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x600/f3f4f6/6366f1?text={{ urlencode($product->name) }}';"
                            >
                        @else
                            <div class="flex flex-col items-center justify-center text-indigo-400">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-400 mt-2">{{ $product->category->name ?? 'Product' }}</span>
                            </div>
                        @endif

                        @if($product->discount_percentage > 0)
                            <span class="absolute top-4 left-4 px-3 py-1.5 bg-emerald-500 text-white text-xs font-extrabold rounded-xl shadow-md">
                                {{ $product->discount_percentage }}% OFF
                            </span>
                        @endif
                    </div>

                    <!-- Thumbnails if gallery exists -->
                    @if($product->images && $product->images->count() > 0)
                        <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2">
                            @if($product->featured_image)
                                <button type="button"
                                        onclick="document.getElementById('mainProductImage').src='{{ asset('storage/' . $product->featured_image) }}'"
                                        class="w-16 h-16 rounded-xl border-2 border-indigo-600 overflow-hidden bg-gray-50 shrink-0 focus:outline-none">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" class="w-full h-full object-cover">
                                </button>
                            @endif

                            @foreach($product->images as $img)
                                <button type="button"
                                        onclick="document.getElementById('mainProductImage').src='{{ asset('storage/' . $img->image_path) }}'"
                                        class="w-16 h-16 rounded-xl border border-gray-200 hover:border-indigo-500 transition overflow-hidden bg-gray-50 shrink-0 focus:outline-none">
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
                                   class="text-xs font-bold text-indigo-600 uppercase tracking-wider hover:underline">
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
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">
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
                                                class="px-4 py-2 text-xs font-semibold rounded-xl border border-gray-300 hover:border-indigo-600 hover:bg-indigo-50/50 transition">
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
                            onclick="alert('Added to cart!')"
                            class="w-full py-4 bg-indigo-600 text-white font-bold text-sm rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/25 transition flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Add to Cart</span>
                        </button>

                        <!-- Trust Features Row -->
                        <div class="grid grid-cols-3 gap-3 pt-4 text-center">
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-indigo-600 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span class="text-[11px] font-semibold text-gray-700 block">100% Genuine</span>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-emerald-600 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="text-[11px] font-semibold text-gray-700 block">7 Days Return</span>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-purple-600 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span class="text-[11px] font-semibold text-gray-700 block">Secure Payment</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Full Description Accordion / Content -->
            @if($product->description)
                <div class="mt-12 pt-8 border-t border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        Product Description & Specifications
                    </h3>
                    <div class="prose max-w-none text-gray-700 text-sm leading-relaxed whitespace-pre-line">
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
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Recommendations</p>
                        <h2 class="text-2xl font-bold text-gray-900 mt-1">Related Products</h2>
                    </div>
                    <a href="{{ route('products', ['category' => $product->category->slug ?? '']) }}" class="text-indigo-600 font-semibold text-sm hover:underline">
                        View All in Category &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $rel)
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg transition p-4 flex flex-col justify-between">
                            <div class="h-44 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center mb-3">
                                @if($rel->featured_image)
                                    <img src="{{ asset('storage/' . $rel->featured_image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-12 h-12 text-indigo-400">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm line-clamp-1 mb-1">{{ $rel->name }}</h4>
                            <p class="text-indigo-600 font-extrabold text-base mb-3">₹{{ number_format($rel->price, 2) }}</p>
                            <a href="{{ route('products.show', $rel->slug) }}" class="w-full py-2 bg-gray-100 hover:bg-indigo-600 hover:text-white transition text-gray-700 text-xs font-semibold rounded-xl text-center">
                                View Product
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="bg-gray-900 text-gray-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center text-xs">
            <p>© {{ date('Y') }} ShopSphere. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
