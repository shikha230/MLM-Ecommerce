<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - FreshBasket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-emerald-50/30 text-gray-800 min-h-screen">

    <!-- Top Navigation Bar -->
    <header class="bg-white/95 backdrop-blur-md border-b border-emerald-100 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                
                <!-- Left: Logo & Navigation -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-green-500 flex items-center justify-center text-white text-xl shadow-md shadow-emerald-600/30">
                            🥬
                        </div>
                        <span class="text-2xl font-extrabold bg-gradient-to-r from-emerald-800 via-green-700 to-teal-800 bg-clip-text text-transparent">
                            FreshBasket
                        </span>
                    </a>
                    <a href="{{ route('home') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-emerald-800 hover:text-emerald-950 transition">
                        <span>&larr;</span> <span>Back to Grocery Store</span>
                    </a>
                </div>

                <!-- Right: Profile Info & Logout -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-bold text-sm flex items-center justify-center shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-900 leading-tight">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-xs text-emerald-700 font-medium">
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
        <div class="bg-gradient-to-r from-emerald-900 via-green-800 to-teal-900 rounded-3xl text-white p-6 sm:p-8 shadow-xl shadow-emerald-950/20 mb-8 relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-200 text-xs font-semibold backdrop-blur-sm mb-3">
                        🌱 Customer Grocery Portal
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Namaste, {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-emerald-100/90 text-sm sm:text-base mt-1 max-w-xl">
                        Aapke taaza grocery orders, wallet cashback aur MLM referral network ka complete dashboard yahan hai.
                    </p>
                </div>

                <!-- Referral Card -->
                @if(auth()->user()->referral_code)
                    <div class="bg-white/10 backdrop-blur-md border border-emerald-400/30 rounded-2xl p-4 sm:p-5 flex flex-col gap-2 min-w-[270px]">
                        <span class="text-xs font-semibold text-emerald-200 uppercase tracking-wider">Your Grocery Referral Code</span>
                        <div class="flex items-center justify-between gap-3 bg-emerald-950/40 border border-emerald-400/20 rounded-xl px-3.5 py-2">
                            <span class="font-mono font-bold text-lg tracking-widest text-emerald-300" id="referralCodeText">
                                {{ auth()->user()->referral_code }}
                            </span>
                            <button type="button"
                                    onclick="copyReferralCode()"
                                    id="copyRefBtn"
                                    class="text-xs bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-extrabold px-3 py-1.5 rounded-lg shadow-sm transition">
                                Copy
                            </button>
                        </div>
                        <span class="text-[11px] text-emerald-200/80">Share with family & friends to earn MLM grocery commissions!</span>
                    </div>
                @endif
            </div>

            <!-- Background decorative shapes -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/3 -mb-10 w-52 h-52 bg-teal-400/20 rounded-full blur-2xl pointer-events-none"></div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-2xl p-5 border border-emerald-100/80 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl border border-emerald-100">
                    🧺
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Grocery Orders</div>
                    <div class="text-xl font-extrabold text-gray-900 mt-0.5">0</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-emerald-100/80 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl border border-teal-100">
                    💰
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Fresh Cashback Wallet</div>
                    <div class="text-xl font-extrabold text-gray-900 mt-0.5">₹0.00</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-emerald-100/80 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 text-green-700 flex items-center justify-center text-2xl border border-green-100">
                    🤝
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">MLM Grocery Network</div>
                    <div class="text-xl font-extrabold text-gray-900 mt-0.5">0 Members</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-emerald-100/80 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl border border-amber-100">
                    ⭐
                </div>
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Fresh Club Membership</div>
                    <div class="text-xl font-extrabold text-emerald-700 mt-0.5">Active</div>
                </div>
            </div>
        </div>

        <!-- Dashboard Layout with Sidebar Navigation Tabs -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-3 border border-emerald-100 shadow-sm sticky top-24">
                    <nav class="space-y-1" id="dashNav">
                        <button type="button"
                                onclick="switchTab('account')"
                                data-tab="account"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition text-left text-emerald-800 bg-emerald-50">
                            <span class="text-lg">👤</span>
                            <span>My Account</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('orders')"
                                data-tab="orders"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-800">
                            <span class="text-lg">🧺</span>
                            <span>Recent Orders</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('history')"
                                data-tab="history"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-800">
                            <span class="text-lg">📜</span>
                            <span>Order Invoices</span>
                        </button>

                        <button type="button"
                                onclick="switchTab('settings')"
                                data-tab="settings"
                                class="tab-nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition text-left text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-800">
                            <span class="text-lg">⚙️</span>
                            <span>Delivery & Profile</span>
                        </button>
                    </nav>

                    <div class="mt-4 pt-4 border-t border-emerald-100 px-2">
                        <a href="{{ route('products') }}" class="flex items-center gap-2 text-xs font-bold text-emerald-700 hover:text-emerald-900 transition">
                            <span>🛒</span>
                            <span>Shop Fresh Groceries</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Panes -->
            <div class="lg:col-span-3">

                <!-- 1. My Account Tab -->
                <div id="tab-account" class="tab-pane bg-white rounded-2xl p-6 sm:p-8 border border-emerald-100 shadow-sm">
                    <div class="flex items-center justify-between pb-6 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">My Account Details</h2>
                            <p class="text-sm text-gray-500">Your profile information and FreshBasket customer overview.</p>
                        </div>
                        <button type="button" onclick="switchTab('settings')" class="text-sm font-bold text-emerald-700 hover:text-emerald-900">
                            Edit Profile &rarr;
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Full Name</div>
                            <div class="text-base font-bold text-gray-900 mt-1">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Email Address</div>
                            <div class="text-base font-bold text-gray-900 mt-1">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Phone Number</div>
                            <div class="text-base font-bold text-gray-900 mt-1">{{ auth()->user()->phone ?? 'Not provided' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Account Role</div>
                            <div class="text-base font-bold text-emerald-700 mt-1 uppercase">{{ auth()->user()->role ?? 'Customer' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Referral Code</div>
                            <div class="text-base font-mono font-bold text-emerald-700 mt-1">{{ auth()->user()->referral_code ?? 'None' }}</div>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="text-xs font-semibold text-gray-400 uppercase">Member Since</div>
                            <div class="text-base font-bold text-gray-900 mt-1">{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : 'Recently' }}</div>
                        </div>
                    </div>
                </div>

                <!-- 2. Recent Orders Tab -->
                <div id="tab-orders" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-emerald-100 shadow-sm">
                    <div class="flex items-center justify-between pb-6 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Recent Grocery Orders</h2>
                            <p class="text-sm text-gray-500">Track your daily essentials & fresh harvest deliveries.</p>
                        </div>
                        <a href="{{ route('products') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-900">
                            + Order Fresh Items
                        </a>
                    </div>

                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 border border-emerald-100">
                            🧺
                        </div>
                        <h3 class="text-base font-bold text-gray-900">Abhi koi grocery orders nahi hain</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto mt-1 mb-6">
                            Aapne abhi tak koi order place nahi kiya hai. Taaza sabziyan, daal, masale aur dairy mangwane ke liye browse karein!
                        </p>
                        <a href="{{ route('products') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-md shadow-emerald-700/20 transition">
                            Explore Fresh Aisles 🥦
                        </a>
                    </div>
                </div>

                <!-- 3. Order History Tab -->
                <div id="tab-history" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-emerald-100 shadow-sm">
                    <div class="pb-6 border-b border-gray-100 mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Order History & Invoices</h2>
                        <p class="text-sm text-gray-500">A complete log of all past purchases and GST grocery invoices.</p>
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
                <div id="tab-settings" class="tab-pane hidden bg-white rounded-2xl p-6 sm:p-8 border border-emerald-100 shadow-sm">
                    <div class="pb-6 border-b border-gray-100 mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Delivery & Profile Settings</h2>
                        <p class="text-sm text-gray-500">Update your grocery delivery address and account details.</p>
                    </div>

                    <form onsubmit="event.preventDefault(); alert('Profile details updated successfully!');" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Full Name</label>
                                <input type="text"
                                       value="{{ auth()->user()->name }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Email Address</label>
                                <input type="email"
                                       value="{{ auth()->user()->email }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Delivery Contact (Phone)</label>
                                <input type="text"
                                       value="{{ auth()->user()->phone ?? '' }}"
                                       placeholder="+91 XXXXX XXXXX"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Referral Code</label>
                                <input type="text"
                                       value="{{ auth()->user()->referral_code ?? 'N/A' }}"
                                       readonly
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm cursor-not-allowed font-mono font-bold">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-sm transition">
                                Save Profile Changes
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
                    btn.classList.add('text-emerald-800', 'bg-emerald-50');
                    btn.classList.remove('text-gray-600', 'hover:bg-emerald-50/50');
                } else {
                    btn.classList.remove('text-emerald-800', 'bg-emerald-50');
                    btn.classList.add('text-gray-600', 'hover:bg-emerald-50/50');
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