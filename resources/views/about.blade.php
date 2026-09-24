<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FreshBasket Farm Fresh Grocery</title>
    <meta name="description" content="Learn about FreshBasket's farm-to-door fresh grocery model, direct farmer sourcing, organic certifications, and cold-chain express delivery.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0fdf4;
            color: #1e293b;
        }
        .hero-green {
            background: linear-gradient(135deg, #14532d 0%, #166534 30%, #15803d 60%, #16a34a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-green::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-800 to-green-700 text-white text-center py-2 text-xs font-semibold tracking-wide">
        🌿 100% Certified Farm-Fresh & Organic Produce | 🚚 Free Express Delivery on orders above ₹499
    </div>

    <!-- Navigation Bar -->
    <header class="bg-white sticky top-0 z-40 border-b border-green-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-700 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-sm">
                    🛒
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-2xl font-black text-green-700 tracking-tight">FreshBasket</span>
                    <span class="text-[10px] text-green-600 font-bold -mt-0.5">Farm Fresh Grocery</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-700">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition">Home</a>
                <a href="{{ route('products') }}" class="hover:text-green-600 transition">Products</a>
                <a href="{{ route('about') }}" class="text-green-600 border-b-2 border-green-600 pb-1 font-bold">About Us</a>
                <a href="{{ route('contact') }}" class="hover:text-green-600 transition">Contact</a>
            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-green-600 px-3 py-2 transition">Sign In</a>
                    <a href="{{ route('register') }}" class="text-xs font-bold bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white px-4 py-2.5 rounded-xl shadow-sm transition">Join FreshBasket</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="text-xs font-bold bg-green-50 text-green-800 border border-green-200 px-4 py-2 rounded-xl hover:bg-green-100 transition">
                        My Account
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-green text-white py-20 px-6">
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-sm text-xs font-bold text-green-200 mb-4 border border-white/20">
                🌱 Farm-to-Fork Purity
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight">
                Pure Sourcing.<br><span class="text-green-300">Fresher Kitchens.</span>
            </h1>
            <p class="mt-6 text-base md:text-lg text-green-100 max-w-2xl mx-auto leading-relaxed">
                At FreshBasket, we connect conscious consumers directly with certified organic cultivators and dairy farmers across India. Zero middlemen, genuine harvest-fresh quality.
            </p>
        </div>
    </section>

    <!-- Core Pillars -->
    <main class="max-w-7xl mx-auto px-6 py-16 flex-1">
        
        <!-- Story Card -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-green-100 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-green-600">Our Mission</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-2 leading-tight">
                        Ending the 4-Day Journey of Vegetables
                    </h2>
                    <p class="mt-4 text-slate-600 leading-relaxed text-sm">
                        In typical grocery supply chains, vegetables spend up to 96 hours travelling through wholesale mandis, distributors, and roadside carts before reaching your kitchen table. Nutrients diminish, and quality is compromised.
                    </p>
                    <p class="mt-3 text-slate-600 leading-relaxed text-sm">
                        FreshBasket harvests at 4:00 AM, conducts cold-water ozone cleansing by 7:00 AM, and delivers directly to your door in temperature-monitored crates before lunch. Real farm freshness you can taste in every single bite.
                    </p>

                    <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-100 text-center">
                        <div class="p-3 bg-green-50/70 rounded-2xl border border-green-100">
                            <span class="text-2xl font-black text-green-700 block">500+</span>
                            <span class="text-[11px] font-semibold text-slate-600">Partner Farms</span>
                        </div>
                        <div class="p-3 bg-green-50/70 rounded-2xl border border-green-100">
                            <span class="text-2xl font-black text-green-700 block">15-30m</span>
                            <span class="text-[11px] font-semibold text-slate-600">Express Delivery</span>
                        </div>
                        <div class="p-3 bg-green-50/70 rounded-2xl border border-green-100">
                            <span class="text-2xl font-black text-green-700 block">100%</span>
                            <span class="text-[11px] font-semibold text-slate-600">Ozone Washed</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80" alt="Fresh Produce Market" class="rounded-3xl shadow-lg w-full h-[380px] object-cover">
                    <div class="absolute -bottom-6 -left-6 bg-gradient-to-r from-emerald-700 to-green-600 text-white p-5 rounded-2xl shadow-xl max-w-xs hidden sm:block">
                        <p class="text-xs font-extrabold uppercase tracking-wider text-green-200">Our Guarantee</p>
                        <p class="text-sm font-bold mt-1">If it's not fresh, we replace it instantly with no questions asked.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 Pillars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl border border-green-100 shadow-sm hover:shadow-md transition group text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-md group-hover:scale-110 transition">
                    🥦
                </div>
                <h3 class="text-xl font-black text-slate-900 mt-6">Natural & Zero Pesticides</h3>
                <p class="text-slate-600 text-xs mt-3 leading-relaxed">
                    We test every lot for pesticide residues and artificial ripening agents. Only genuine, certified farm lots make it into FreshBasket boxes.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-green-100 shadow-sm hover:shadow-md transition group text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-600 to-teal-600 text-white rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-md group-hover:scale-110 transition">
                    ❄️
                </div>
                <h3 class="text-xl font-black text-slate-900 mt-6">Cold Chain Preservation</h3>
                <p class="text-slate-600 text-xs mt-3 leading-relaxed">
                    From refrigerated transport to insulated dark stores, our leafy greens and dairy products maintain constant 4°C chilled temperatures.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-green-100 shadow-sm hover:shadow-md transition group text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-teal-600 to-green-600 text-white rounded-2xl flex items-center justify-center text-3xl mx-auto shadow-md group-hover:scale-110 transition">
                    🤝
                </div>
                <h3 class="text-xl font-black text-slate-900 mt-6">Direct Farmer Fair Pay</h3>
                <p class="text-slate-600 text-xs mt-3 leading-relaxed">
                    Our partner farmers receive up to 40% higher income compared to traditional APMC mandis, fostering sustainable local agriculture.
                </p>
            </div>
        </div>

    </main>

    <!-- Bottom CTA -->
    <section class="bg-gradient-to-r from-emerald-800 via-green-700 to-teal-800 py-14 text-white text-center px-6">
        <h2 class="text-3xl font-black">Experience the True Taste of Fresh Produce</h2>
        <p class="text-green-100 mt-2 text-sm max-w-xl mx-auto">Get farm-harvested vegetables, fruits, dairy, and pulses delivered right to your door.</p>
        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ route('products') }}" class="px-7 py-3.5 bg-white text-green-800 font-extrabold text-sm rounded-xl hover:bg-green-50 shadow-lg transition">
                🛒 Explore Fresh Groceries
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-xs">
        <p>© {{ date('Y') }} FreshBasket. Farm Fresh Grocery. All rights reserved.</p>
    </footer>

</body>
</html>
