<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="/" class="text-2xl font-bold text-indigo-600">
                ShopSphere
            </a>

            <div class="hidden md:flex items-center gap-8">

                <a href="/" class="text-gray-600 hover:text-indigo-600">
                    Home
                </a>

                <a href="/products" class="text-gray-600 hover:text-indigo-600">
                    Products
                </a>

                <a href="/about" class="text-gray-600 hover:text-indigo-600">
                    About Us
                </a>

                <a href="/contact" class="text-indigo-600 font-semibold">
                    Contact
                </a>

                <a href="/login" class="text-gray-600 hover:text-indigo-600">
                    Login
                </a>

                <a href="/register"
                   class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
                    Register
                </a>

            </div>

        </div>
    </nav>


    <!-- Header -->
    <section class="bg-indigo-600 text-white py-16">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-4xl md:text-5xl font-bold">
                Contact Us
            </h1>

            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">
                Have a question? We would love to hear from you.
            </p>

        </div>

    </section>


    <!-- Contact Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            <!-- Contact Information -->
            <div class="space-y-6">

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <div class="text-3xl">
                        📧
                    </div>

                    <h3 class="text-lg font-bold mt-4">
                        Email
                    </h3>

                    <p class="text-gray-500 mt-2">
                        support@shopsphere.com
                    </p>

                </div>


                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <div class="text-3xl">
                        📞
                    </div>

                    <h3 class="text-lg font-bold mt-4">
                        Phone
                    </h3>

                    <p class="text-gray-500 mt-2">
                        +91 98765 43210
                    </p>

                </div>


                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <div class="text-3xl">
                        📍
                    </div>

                    <h3 class="text-lg font-bold mt-4">
                        Address
                    </h3>

                    <p class="text-gray-500 mt-2">
                        India
                    </p>

                </div>

            </div>


            <!-- Contact Form -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-2xl shadow-sm p-8">

                    <h2 class="text-2xl font-bold text-gray-900">
                        Send Us a Message
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Fill out the form and our team will get back to you.
                    </p>


                    <form class="mt-8">

                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Name -->
                            <div>

                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Your Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Enter your name"
                                    class="w-full border border-gray-300 rounded-lg
                                           px-4 py-3
                                           focus:border-indigo-500
                                           focus:ring-2
                                           focus:ring-indigo-200
                                           outline-none"
                                >

                            </div>


                            <!-- Email -->
                            <div>

                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                >
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    class="w-full border border-gray-300 rounded-lg
                                           px-4 py-3
                                           focus:border-indigo-500
                                           focus:ring-2
                                           focus:ring-indigo-200
                                           outline-none"
                                >

                            </div>

                        </div>


                        <!-- Subject -->
                        <div class="mt-6">

                            <label
                                for="subject"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Subject
                            </label>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                placeholder="Enter subject"
                                class="w-full border border-gray-300 rounded-lg
                                       px-4 py-3
                                       focus:border-indigo-500
                                       focus:ring-2
                                       focus:ring-indigo-200
                                       outline-none"
                            >

                        </div>


                        <!-- Message -->
                        <div class="mt-6">

                            <label
                                for="message"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Message
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Write your message..."
                                class="w-full border border-gray-300 rounded-lg
                                       px-4 py-3
                                       focus:border-indigo-500
                                       focus:ring-2
                                       focus:ring-indigo-200
                                       outline-none"
                            ></textarea>

                        </div>


                        <!-- Button -->
                        <button
                            type="submit"
                            class="mt-6 bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   font-semibold
                                   px-8 py-3
                                   rounded-lg
                                   transition"
                        >
                            Send Message
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">

        <div class="max-w-7xl mx-auto px-6 py-10 text-center">

            <p class="text-2xl font-bold text-white">
                ShopSphere
            </p>

            <p class="mt-3 text-sm">
                Your trusted online shopping platform.
            </p>

            <p class="mt-6 text-sm text-gray-500">
                © {{ date('Y') }} ShopSphere. All rights reserved.
            </p>

        </div>

    </footer>

</body>
</html>