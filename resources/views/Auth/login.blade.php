<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">

                <a
                    href="/"
                    class="text-3xl font-bold text-indigo-600"
                >
                    ShopSphere
                </a>

                <h1 class="text-2xl font-bold text-gray-900 mt-5">
                    Welcome Back
                </h1>

                <p class="text-gray-500 mt-2">
                    Login to continue to your account
                </p>

            </div>


            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                        <p class="text-sm text-green-600">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif


                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">

                        <ul class="text-sm text-red-600 space-y-1">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>
                @endif


                <form
                    action="{{ route('login.store') }}"
                    method="POST"
                >

                    @csrf


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
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                   outline-none"
                        >

                    </div>
                   <div class="flex justify-end mb-6"><a href="{{ route('password.request') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Forgot Password?
                            </a>
                    </div> 

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6">

                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="1"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded"
                        >

                        <label
                            for="remember"
                            class="ml-2 text-sm text-gray-600"
                        >
                            Remember me
                        </label>
         
                    </div>


                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white font-semibold py-3 rounded-lg
                               transition duration-200"
                    >
                        Login
                    </button>

                </form>


                <!-- Register Link -->
                <div class="text-center mt-6">

                    <p class="text-gray-600 text-sm">

                        Don't have an account?

                        <a
                            href="{{ route('register') }}"
                            class="text-indigo-600 hover:text-indigo-700 font-semibold"
                        >
                            Create Account
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