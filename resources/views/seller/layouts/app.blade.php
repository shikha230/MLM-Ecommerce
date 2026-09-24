<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Central') - ShopSphere</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .sidebar-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
        }
        .sidebar-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        }
        .badge-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col lg:flex-row">

    <!-- Mobile Header -->
    <div class="lg:hidden bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between sticky top-0 z-50 shadow-md">
        <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2 font-bold text-lg text-white">
            <span class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-sm">🏪</span>
            <span>Seller Central</span>
        </a>
        <button type="button" id="mobileMenuBtn" class="p-2 rounded-lg bg-slate-800 text-gray-300 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-slate-300 flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:static lg:h-screen shrink-0 border-r border-slate-800">
        
        <!-- Brand Header -->
        <div class="p-6 border-b border-slate-800 flex items-center justify-between">
            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 text-white text-decoration-none">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white text-xl shadow-lg">
                    🏪
                </div>
                <div>
                    <span class="text-lg font-extrabold tracking-tight text-white block leading-tight">Seller Central</span>
                    <span class="text-[11px] font-medium text-indigo-400 uppercase tracking-wider block">ShopSphere Vendor</span>
                </div>
            </a>
            <button type="button" id="closeSidebarBtn" class="lg:hidden text-gray-400 hover:text-white p-1">
                &times;
            </button>
        </div>

        <!-- Store Profile Pill -->
        @php
            $currentSeller = auth()->user()->seller;
        @endphp
        @if($currentSeller)
            <div class="px-5 py-4 border-b border-slate-800/80 bg-slate-950/40">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($currentSeller->store_name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-sm font-semibold text-white truncate">{{ $currentSeller->store_name }}</div>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-[11px] text-emerald-400 font-medium capitalize">{{ $currentSeller->status }}</span>
                            <span class="text-[11px] text-slate-500">•</span>
                            <span class="text-[11px] text-amber-400 font-semibold">★ {{ number_format($currentSeller->rating, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <div class="text-[11px] uppercase font-bold text-slate-500 px-3 pb-2 tracking-wider">Main Navigation</div>

            <a href="{{ route('seller.dashboard') }}" class="sidebar-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                <span class="text-lg">📊</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('seller.products.index') }}" class="sidebar-link {{ request()->routeIs('seller.products.*') && !request()->routeIs('seller.products.create') ? 'active' : '' }}">
                <span class="text-lg">🛍️</span>
                <span>All Products</span>
            </a>

            <a href="{{ route('seller.products.create') }}" class="sidebar-link {{ request()->routeIs('seller.products.create') ? 'active' : '' }}">
                <span class="text-lg">➕</span>
                <span>Add Product</span>
            </a>

            <a href="{{ route('seller.orders.index') }}" class="sidebar-link {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}">
                <span class="text-lg">📦</span>
                <span>Orders</span>
            </a>

            <a href="{{ route('seller.earnings') }}" class="sidebar-link {{ request()->routeIs('seller.earnings') ? 'active' : '' }}">
                <span class="text-lg">💰</span>
                <span>Earnings & Sales</span>
            </a>

            <div class="text-[11px] uppercase font-bold text-slate-500 px-3 pt-5 pb-2 tracking-wider">Settings & Store</div>

            <a href="{{ route('seller.profile') }}" class="sidebar-link {{ request()->routeIs('seller.profile') ? 'active' : '' }}">
                <span class="text-lg">⚙️</span>
                <span>Store Profile</span>
            </a>

            <a href="{{ route('home') }}" class="sidebar-link">
                <span class="text-lg">🌐</span>
                <span>Go to Website</span>
                <span class="text-[11px] bg-indigo-500/20 text-indigo-300 font-semibold px-2 py-0.5 rounded ml-auto">Storefront &rarr;</span>
            </a>
        </nav>

        <!-- User Logout Footer -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/40">
            <form action="{{ route('seller.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800/80 hover:bg-rose-900/40 text-slate-300 hover:text-rose-400 text-sm font-semibold transition border border-slate-700/60 hover:border-rose-800/50">
                    <span>🚪</span>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Backdrop for mobile drawer -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden backdrop-blur-sm"></div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- Top App Bar -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-20 px-6 py-4 flex items-center justify-between shadow-xs">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 leading-tight">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-gray-500 mt-0.5">@yield('page-subtitle', 'Manage your products, orders, and store operations.')</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-slate-100 hover:bg-indigo-50 text-slate-700 hover:text-indigo-600 text-sm font-semibold rounded-xl border border-slate-200 transition shadow-xs">
                    <span class="text-base">🌐</span>
                    <span>Go to Website</span>
                </a>

                <a href="{{ route('seller.products.create') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition">
                    <span>➕</span>
                    <span>New Product</span>
                </a>

                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>

                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-sm flex items-center justify-center shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Notifications -->
        <div class="px-6 pt-5">
            @if(session('success'))
                <div class="flex items-center justify-between p-4 mb-4 text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-2xl shadow-xs">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">✅</span>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center justify-between p-4 mb-4 text-rose-800 bg-rose-50 border border-rose-200 rounded-2xl shadow-xs">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">⚠️</span>
                        <span class="text-sm font-semibold">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 mb-4 text-rose-800 bg-rose-50 border border-rose-200 rounded-2xl shadow-xs">
                    <div class="flex items-center gap-2 font-bold text-sm mb-1">
                        <span>⚠️</span>
                        <span>Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 pl-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Page Body -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="p-6 border-t border-gray-200 text-center text-xs text-gray-400 bg-white">
            &copy; {{ date('Y') }} ShopSphere Seller Central. All rights reserved.
        </footer>
    </div>

    <!-- Mobile Drawer JS -->
    <script>
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        if (mobileBtn) mobileBtn.addEventListener('click', toggleSidebar);
        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (backdrop) backdrop.addEventListener('click', toggleSidebar);
    </script>
    @stack('scripts')
</body>
</html>
