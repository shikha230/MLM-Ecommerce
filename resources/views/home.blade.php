<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a href="/" class="text-2xl font-bold text-violet-600">
                ShopSphere
            </a>

            <div class="hidden items-center gap-8 md:flex">

                <a href="/" class="font-medium text-violet-600">
                    Home
                </a>

                <a href="#products"
                   class="font-medium text-gray-600 hover:text-violet-600">
                    Products
                </a>

                <a href="#about"
                   class="font-medium text-gray-600 hover:text-violet-600">
                    About Us
                </a>

                <a href="#contact"
                   class="font-medium text-gray-600 hover:text-violet-600">
                    Contact
                </a>

                <a href="/login"
                   class="font-semibold text-violet-600">
                    Login
                </a>

                <a href="/register"
                   class="rounded-lg bg-violet-600 px-5 py-2.5 font-semibold text-white hover:bg-violet-700">
                    Register
                </a>

            </div>

            <button
                id="menuButton"
                class="text-2xl md:hidden">
                ☰
            </button>

        </div>

        <!-- Mobile Menu -->

        <div id="mobileMenu" class="hidden border-t md:hidden">

            <div class="flex flex-col gap-4 px-6 py-5">

                <a href="/">Home</a>

                <a href="#products">Products</a>

                <a href="#about">About Us</a>

                <a href="#contact">Contact</a>

                <a href="/login"
                   class="font-semibold text-violet-600">
                    Login
                </a>

                <a href="/register"
                   class="rounded-lg bg-violet-600 px-5 py-2.5 text-center font-semibold text-white">
                    Register
                </a>

            </div>

        </div>

    </nav>


    <!-- Hero -->

    <section class="bg-gradient-to-br from-violet-50 via-white to-indigo-50">

        <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-24 md:grid-cols-2">

            <div>

                <span class="inline-block rounded-full bg-violet-100 px-4 py-2 text-sm font-semibold text-violet-700">
                    Smart Shopping. Better Rewards.
                </span>

                <h1 class="mt-6 text-5xl font-extrabold leading-tight text-gray-900 md:text-6xl">

                    Shop Smart.
                    
                    <span class="block text-violet-600">
                        Earn More.
                    </span>

                </h1>

                <p class="mt-6 max-w-xl text-lg leading-8 text-gray-600">
                    Discover quality products from trusted sellers
                    and enjoy a smarter shopping experience with
                    exciting referral rewards.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <a href="#products"
                       class="rounded-lg bg-violet-600 px-6 py-3 font-semibold text-white shadow-lg hover:bg-violet-700">
                        Explore Products →
                    </a>

                    <a href="#about"
                       class="rounded-lg border border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 hover:border-violet-600 hover:text-violet-600">
                        Learn More
                    </a>

                </div>

                <div class="mt-10 flex gap-10">

                    <div>
                        <h3 class="text-2xl font-bold">10K+</h3>
                        <p class="text-sm text-gray-500">Products</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold">5K+</h3>
                        <p class="text-sm text-gray-500">Customers</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold">500+</h3>
                        <p class="text-sm text-gray-500">Sellers</p>
                    </div>

                </div>

            </div>


            <div class="flex justify-center">

                <div class="flex h-[420px] w-[420px] items-center justify-center rounded-[40px] bg-violet-100">

                    <div class="flex h-56 w-56 items-center justify-center rounded-full bg-white text-8xl shadow-xl">
                        🛒
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Categories -->

    <section class="px-6 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="mb-12 text-center">

                <span class="text-sm font-bold tracking-widest text-violet-600">
                    EXPLORE
                </span>

                <h2 class="mt-2 text-4xl font-bold text-gray-900">
                    Shop by Category
                </h2>

                <p class="mt-3 text-gray-500">
                    Find everything you need in one place.
                </p>

            </div>


            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">

                @foreach([
                    ['👕', 'Fashion'],
                    ['📱', 'Electronics'],
                    ['🏠', 'Home & Living'],
                    ['💄', 'Beauty'],
                    ['🎒', 'Accessories'],
                    ['⚽', 'Sports']
                ] as $category)

                    <div class="rounded-2xl border border-gray-200 p-6 text-center transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-xl bg-violet-50 text-3xl">
                            {{ $category[0] }}
                        </div>

                        <h3 class="mt-4 font-bold">
                            {{ $category[1] }}
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Explore products
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- Products -->

    <section id="products" class="bg-gray-50 px-6 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="mb-12 flex items-end justify-between">

                <div>

                    <span class="text-sm font-bold tracking-widest text-violet-600">
                        OUR STORE
                    </span>

                    <h2 class="mt-2 text-4xl font-bold">
                        Featured Products
                    </h2>

                </div>

                <a href="#"
                   class="font-semibold text-violet-600">
                    View All →
                </a>

            </div>


            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                @foreach([
                    ['👟', 'Premium Running Shoes', '₹2,499'],
                    ['⌚', 'Smart Watch Pro', '₹1,999'],
                    ['🎧', 'Wireless Headphones', '₹1,499'],
                    ['🎒', 'Travel Backpack', '₹999']
                ] as $product)

                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">

                        <div class="flex h-52 items-center justify-center bg-gray-100 text-7xl">
                            {{ $product[0] }}
                        </div>

                        <div class="p-5">

                            <span class="text-xs font-semibold text-violet-600">
                                Featured Product
                            </span>

                            <h3 class="mt-2 font-bold">
                                {{ $product[1] }}
                            </h3>

                            <div class="mt-2 text-sm text-yellow-500">
                                ★★★★★
                            </div>

                            <div class="mt-3 flex items-center justify-between">

                                <strong class="text-xl">
                                    {{ $product[2] }}
                                </strong>

                                <button class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-violet-600">
                                    Add Cart
                                </button>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- Referral / MLM -->

    <section id="about" class="bg-gray-900 px-6 py-20 text-white">

        <div class="mx-auto grid max-w-7xl gap-12 md:grid-cols-2 md:items-center">

            <div>

                <span class="text-sm font-bold tracking-widest text-violet-400">
                    REFER & EARN
                </span>

                <h2 class="mt-3 text-4xl font-bold">
                    Shop, Refer &
                    <span class="text-violet-400">
                        Earn Rewards
                    </span>
                </h2>

                <p class="mt-5 leading-8 text-gray-400">
                    Invite your friends and family to join our platform.
                    Eligible purchases through your referral network
                    can generate rewards according to the platform's
                    referral program.
                </p>

                <a href="/register"
                   class="mt-7 inline-block rounded-lg bg-violet-600 px-6 py-3 font-semibold hover:bg-violet-700">
                    Join Now →
                </a>

            </div>


            <div class="space-y-4">

                @foreach([
                    ['01', 'Create Account', 'Register your account.'],
                    ['02', 'Share Referral', 'Invite friends using your referral link.'],
                    ['03', 'Build Network', 'Your referral network grows automatically.'],
                    ['04', 'Earn Rewards', 'Eligible purchases can generate rewards.']
                ] as $step)

                    <div class="flex items-center gap-5 rounded-xl border border-gray-700 p-5">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-violet-600 font-bold">
                            {{ $step[0] }}
                        </div>

                        <div>

                            <h3 class="font-bold">
                                {{ $step[1] }}
                            </h3>

                            <p class="text-sm text-gray-400">
                                {{ $step[2] }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- Why Choose Us -->

    <section class="px-6 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="mb-12 text-center">

                <span class="text-sm font-bold tracking-widest text-violet-600">
                    WHY CHOOSE US
                </span>

                <h2 class="mt-2 text-4xl font-bold">
                    Everything You Need
                </h2>

            </div>


            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                @foreach([
                    ['🔒', 'Secure Payments', 'Secure payment processing for your orders.'],
                    ['🚚', 'Easy Shopping', 'Browse, cart and checkout with ease.'],
                    ['💳', 'UPI Payments', 'Convenient digital payment options.'],
                    ['⭐', 'Customer Reviews', 'Read product reviews before purchasing.']
                ] as $feature)

                    <div class="rounded-2xl border border-gray-200 p-7 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-xl bg-violet-50 text-3xl">
                            {{ $feature[0] }}
                        </div>

                        <h3 class="mt-5 font-bold">
                            {{ $feature[1] }}
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-gray-500">
                            {{ $feature[2] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- Contact -->

    <section id="contact" class="bg-gray-50 px-6 py-20">

        <div class="mx-auto max-w-7xl">

            <div class="mb-12 text-center">

                <span class="text-sm font-bold tracking-widest text-violet-600">
                    CONTACT
                </span>

                <h2 class="mt-2 text-4xl font-bold">
                    Get In Touch
                </h2>

            </div>


            <div class="grid gap-6 md:grid-cols-3">

                <div class="rounded-2xl bg-white p-8 text-center shadow-sm">
                    <div class="text-3xl">📧</div>
                    <h3 class="mt-4 font-bold">Email Us</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        support@example.com
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-8 text-center shadow-sm">
                    <div class="text-3xl">📞</div>
                    <h3 class="mt-4 font-bold">Call Us</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        +91 98765 43210
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-8 text-center shadow-sm">
                    <div class="text-3xl">📍</div>
                    <h3 class="mt-4 font-bold">Location</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        India
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->

    <footer class="bg-gray-950 px-6 py-14 text-white">

        <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-4">

            <div class="md:col-span-2">

                <h2 class="text-2xl font-bold text-violet-400">
                    ShopSphere
                </h2>

                <p class="mt-4 max-w-md text-sm leading-7 text-gray-400">
                    Your trusted destination for smart shopping,
                    quality products and exciting rewards.
                </p>

            </div>


            <div>

                <h3 class="font-bold">
                    Quick Links
                </h3>

                <div class="mt-4 flex flex-col gap-3 text-sm text-gray-400">

                    <a href="/">Home</a>
                    <a href="#products">Products</a>
                    <a href="#about">About Us</a>
                    <a href="#contact">Contact</a>

                </div>

            </div>


            <div>

                <h3 class="font-bold">
                    Account
                </h3>

                <div class="mt-4 flex flex-col gap-3 text-sm text-gray-400">

                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                    <a href="#">My Orders</a>
                    <a href="#">My Account</a>

                </div>

            </div>

        </div>


        <div class="mx-auto mt-12 max-w-7xl border-t border-gray-800 pt-6 text-center text-xs text-gray-500">

            © {{ date('Y') }} ShopSphere. All rights reserved.

        </div>

    </footer>

</body>
</html>