<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <!-- Logo / Brand -->
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-bold text-indigo-600">
                    ShopSphere
                </a>

                <h1 class="text-2xl font-bold text-gray-900 mt-5">
                    Create your account
                </h1>

                <p class="text-gray-500 mt-2">
                    Join ShopSphere and start shopping
                </p>
            </div>


            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('register.store') }}" method="POST">

                    @csrf

                    <!-- Name -->
                    <div class="mb-5">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            placeholder="Enter your full name"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >
                    </div>


                    <!-- Email -->
                    <div class="mb-5">
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
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="Enter your email"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >
                    </div>


                    <!-- Phone -->
                    <div class="mb-5">
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            autocomplete="tel"
                            placeholder="Enter your phone number"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >
                    </div>

                    <!-- Referral Code -->
                <div class="mb-5">
                  <label
                   for="referral_code"
                    class="block text-sm font-medium text-gray-700 mb-2">Referral Code
                 <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="text" id="referral_code "name="referral_code"value="{{ old('referral_code', request('ref')) }}"
                placeholder="Enter referral code"
                class="w-full rounded-lg border border-gray-300 px-4 py-3
                focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
               outline-none">
              </div>
                    <!-- Password -->
                    <div class="mb-5">
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimum 8 characters"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >
                    </div>


                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >
                    </div>


                    <!-- Register Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white font-semibold py-3 rounded-lg
                               transition duration-200"
                    >
                        Create Account
                    </button>

                </form>


                <!-- Login Link -->
                <div class="text-center mt-6">

                    <p class="text-gray-600 text-sm">
                        Already have an account?

                        <a
                            href="/login"
                            class="text-indigo-600 hover:text-indigo-700 font-semibold"
                        >
                            Login
                        </a>
                    </p>

                </div>

            </div>


            <!-- Back Home -->
            <div class="text-center mt-6">

                <a
                    href="/"
                    class="text-sm text-gray-500 hover:text-indigo-600"
                >
                    ← Back to Home
                </a>

            </div>

        </div>

    </div>

</body>
</html>