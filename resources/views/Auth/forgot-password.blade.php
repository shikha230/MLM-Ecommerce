<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - FreshBasket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-emerald-50 to-green-100/50 flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-md">

        <!-- Logo / Heading -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-green-500 flex items-center justify-center text-white text-xl shadow-md shadow-emerald-600/30">
                    🥬
                </span>
                <span class="text-3xl font-extrabold bg-gradient-to-r from-emerald-800 via-green-700 to-teal-800 bg-clip-text text-transparent">
                    FreshBasket
                </span>
            </a>

            <h1 class="text-2xl font-extrabold text-gray-900 mt-5">
                Forgot Password?
            </h1>

            <p class="text-gray-500 text-sm mt-2">
                Enter your registered grocery account email and we'll send you a password reset link.
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-emerald-900/5 border border-emerald-100 p-8">

            <!-- Success Message -->
            @if (session('status'))
                <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4">
                    <p class="text-sm font-semibold text-emerald-700">
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                    <ul class="text-sm text-red-600 space-y-1 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Forgot Password Form -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="Enter your registered email"
                        class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition"
                    >
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3 rounded-xl shadow-md shadow-emerald-700/20 transition duration-200"
                >
                    Send Reset Link
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm text-emerald-700 hover:text-emerald-900 font-bold transition">
                    ← Back to Sign In
                </a>
            </div>

        </div>

    </div>

</body>
</html>
