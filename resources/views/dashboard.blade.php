<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - ShopSphere</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <!-- Top Navigation Bar -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                
                <!-- Left: Logo & Navigation -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            🛍️ ShopSphere
                        </span>
                    </a>
                    <a href="{{ route('home') }}" class="hidden sm:inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition">
                        &larr; Back to Shop
                    </a>
                </div>

                <!-- Right: Profile Info & Logout -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-sm flex items-center justify-center shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-800 leading-tight">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </div>

                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 text-xs font-semibold transition">
                            🚪 Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl text-white p-6 sm:p-8 shadow-xl mb-8 relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-xs font-medium backdrop-blur-sm mb-3">
                        ✨ Customer Dashboard
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                        Welcome back, {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-white/80 text-sm sm:text-base mt-1">
                        Manage your orders, account details, and referral network in one place.
                    </p>
                </div>

                <!-- Referral Card -->
                @if(auth()->user()->referral_code)
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 sm:p-5 flex flex-col gap-2 min-w-[260px]">
                        <span class="text-xs font-medium text-indigo-100 uppercase tracking-wider">Your Referral Code</span>
                        <div class="flex items-center justify-between gap-3 bg-white/20 rounded-xl px-3.5 py-2">
                            <span class="font-mono font-bold text-lg tracking-widest text-white" id="referralCodeText">
                                {{ auth()->user()->referral_code }}
                            </span>
                            <button type="button"
                                    onclick="copyReferralCode()"
                                    id="copyRefBtn"
                                    class="text-xs bg-white text-indigo-700 hover:bg-indigo-50 font-bold px-2.5 py-1 rounded-lg shadow-sm transition">
                                Copy
                            </button>
                        </div>
                        <span class="text-[11px] text-white/70">Share with friends & earn MLM bonus!</span>
                    </div>
                @endif
            </div>

            <!-- Background decorative shapes -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-60 h-60 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-1/3 -mb-10 w-48 h-48 bg-purple-400/20 rounded-full blur-xl"></div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl">
                    📦
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-400 uppercase">Total Orders</div>
                    <div class="text-xl font-bold text-gray-900 mt-0.5">0</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                    💰
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-400 uppercase">Wallet Balance</div>
                    <div class="text-xl font-bold text-gray-900 mt-0.5">₹0.00</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl">
                    🤝
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-400 uppercase">Referral Team</div>
                    <div class="text-xl font-bold text-gray-900 mt-0.5">0 Members</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl">
                    ⭐
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-400 uppercase">Membership</div>
                    <div class="text-xl font-bold text-gray-900 mt-0.5">Active</div>
                </div>
            </div>
        </div>

        <!-- Dashboard Layout with Sidebar Navigation Tabs -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-3 border border-gray-100 shadow-sm sticky top-24">
                    <nav class="space-y-1" id="dashNav">
                        <button type="button"
                                onclick="switchTab('account')"
                                data-tab="account"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-indigo-600 bg-indigo-50">
                            <span class="text-lg">👤</span>
                            <span>My Account</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('orders')"
                                data-tab="orders"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <span class="text-lg">📦</span>
                            <span>Recent Orders</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('history')"
                                data-tab="history"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <span class="text-lg">📜</span>
                            <span>Order History</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('settings')"
                                data-tab="settings"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <span class="text-lg">⚙️</span>
                            <span>Profile Settings</span>
                        </button>
                    </nav>

                    <div class="mt-4 pt-4 border-t border-gray-100 px-2">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-indigo-600">
                            <span>🛍️</span>
                            <span>Continue Shopping</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Panes -->
            <div class="lg:col-span-3">

                <!-- 1. My Account Tab -->
                <div id="tab-account" class="tab-pane bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between pb-6 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">My Account Details</h2>
                            <p class="text-sm text-gray-500">Your profile information and overview.</p>
                        </div>
                        <button type="button" onclick="switchTab('settings')" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                            Edit Profile &rarr;
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Full Name</div>
                            <div class="text-base font-semibold text-gray-900 mt-1">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Email Address</div>
                            <div class="text-base font-semibold text-gray-900 mt-1">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Phone Number</div>
                            <div class="text-base font-semibold text-gray-900 mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Account Role</div>
                            <div class="text-base font-semibold text-indigo-600 mt-1 uppercase">{{ auth()->user()->role ?? 'Customer' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Referral Code</div>
                            <div class="text-base font-mono font-bold text-purple-600 mt-1">{{ auth()->user()->referral_code ?? 'None' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-medium text-gray-400 uppercase">Member Since</div>
                            <div class="text-base font-semibold text-gray-900 mt-1">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : 'Recently' }}</div>
                        </div>
                    </div>
                </div>

                <!-- 2. Recent Orders Tab -->
                <div id="tab-orders" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between pb-6 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Recent Orders</h2>
                            <p class="text-sm text-gray-500">Track and view your recent purchases.</p>
                        </div>
                        <a href="{{ route('products') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                            + Explore Products
                        </a>
                    </div>

                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                            📦
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Abhi koi recent orders nahi hain</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto mt-1 mb-6">
                            Aapne abhi tak koi order place nahi kiya hai. Browse karke apne pasandida products khareedein!
                        </p>
                        <a href="{{ route('products') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md transition">
                            Start Shopping Now 🛍️
                        </a>
                    </div>
                </div>

                <!-- 3. Order History Tab -->
                <div id="tab-history" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="pb-6 border-b border-gray-100 mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Order History</h2>
                        <p class="text-sm text-gray-500">A complete log of all past purchases and invoices.</p>
                    </div>

                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                            📜
                        </div>
                        <h3 class="text-base font-bold text-gray-900">No order history available</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto mt-1">
                            Jab aap orders complete karenge, unki invoice aur details yahan show hongi.
                        </p>
                    </div>
                </div>

                <!-- 4. Profile Settings Tab -->
                <div id="tab-settings" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="pb-6 border-b border-gray-100 mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Profile Settings</h2>
                        <p class="text-sm text-gray-500">Update your account information and password.</p>
                    </div>

                    <form onsubmit="event.preventDefault(); alert('Profile details updated successfully!');" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text"
                                       value="{{ auth()->user()->name }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                                <input type="email"
                                       value="{{ auth()->user()->email }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Phone Number</label>
                                <input type="text"
                                       value="{{ auth()->user()->phone ?? '' }}"
                                       placeholder="+91 XXXXX XXXXX"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Referral Code</label>
                                <input type="text"
                                       value="{{ auth()->user()->referral_code ?? 'N/A' }}"
                                       readonly
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                            <button type="submit"
                                    class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-sm transition">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </main>

    <!-- Interactive Script for Tab Switching & Hash Navigation -->
    <script>
        function switchTab(tabKey) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));

            // Show selected pane
            const activePane = document.getElementById('tab-' + tabKey);
            if (activePane) {
                activePane.classList.remove('hidden');
            }

            // Update nav buttons
            document.querySelectorAll('.tab-nav-btn').forEach(btn => {
                if (btn.getAttribute('data-tab') === tabKey) {
                    btn.classList.add('text-indigo-600', 'bg-indigo-50');
                    btn.classList.remove('text-gray-600', 'hover:bg-gray-50');
                } else {
                    btn.classList.remove('text-indigo-600', 'bg-indigo-50');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-50');
                }
            });

            // Update URL hash without scrolling
            history.replaceState(null, null, '#' + tabKey);
        }

        // Handle URL hash on load (e.g. #orders, #history, #settings, #account)
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#', '');
            if (hash && ['account', 'orders', 'history', 'settings'].includes(hash)) {
                switchTab(hash);
            } else {
                switchTab('account');
            }
        });

        // Copy referral code helper
        function copyReferralCode() {
            const text = document.getElementById('referralCodeText').innerText.trim();
            navigator.clipboard.writeText(text).then(() => {
                const btn = document.getElementById('copyRefBtn');
                const orig = btn.innerText;
                btn.innerText = 'Copied! ✅';
                setTimeout(() => btn.innerText = orig, 2000);
            });
        }
    </script>

</body>
</html>