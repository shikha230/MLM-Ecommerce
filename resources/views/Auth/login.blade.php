<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - FreshBasket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
            margin: 0;
            color: #1e293b;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 4px 12px -2px rgba(0, 0, 0, 0.03);
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            color: #0f172a;
            background: #fafafa;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .form-control:focus {
            border-color: #16a34a;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }
        .form-control::placeholder {
            color: #94a3b8;
            font-size: 13px;
        }
        .btn-primary {
            width: 100%;
            padding: 11px 18px;
            background: #16a34a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.25);
            font-family: inherit;
        }
        .btn-primary:hover {
            background: #15803d;
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35);
            transform: translateY(-1px);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen py-10 px-4">

    <div class="w-full" style="max-width: 440px;">

        <!-- Brand & Heading -->
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-decoration-none group">
                <span class="w-9 h-9 rounded-xl bg-green-600 flex items-center justify-center text-white text-lg shadow-sm">
                    🛒
                </span>
                <span class="text-2xl font-extrabold text-green-700 tracking-tight">
                    FreshBasket
                </span>
            </a>

            <h1 class="text-2xl font-extrabold text-slate-900 mt-4 mb-1">
                Welcome back
            </h1>
            <p class="text-slate-500 text-xs sm:text-sm m-0">
                Sign in to your FreshBasket account
            </p>
        </div>

        <!-- Login Card -->
        <div class="auth-card p-6 sm:p-8">

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center gap-2">
                    <span class="text-base">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Flash Status Message (e.g. password reset) -->
            @if (session('status'))
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center gap-2">
                    <span class="text-base">ℹ️</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200">
                    <div class="text-xs font-bold text-rose-800 mb-1 flex items-center gap-1.5">
                        <span>⚠️</span> Please fix the following:
                    </div>
                    <ul class="text-xs text-rose-600 m-0 pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="name@example.com"
                        class="form-control"
                    >
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="form-label" style="margin-bottom:0;">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-green-600 hover:text-green-700 text-decoration-none">
                            Forgot password?
                        </a>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="form-control"
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-5">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        value="1"
                        class="accent-green-600 rounded"
                        style="width: 15px; height: 15px; cursor: pointer;"
                    >
                    <label for="remember" class="ml-2 text-xs text-slate-600 font-medium cursor-pointer" style="margin-bottom:0;">
                        Remember me on this device
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">
                    Sign In
                </button>
            </form>

            <!-- Register Links -->
            <div class="text-center mt-6 pt-5 border-t border-slate-100 space-y-2">
                <p class="text-slate-600 text-xs sm:text-sm m-0">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold ml-1 text-decoration-none">
                        Create an Account
                    </a>
                </p>
                <p class="text-xs text-slate-500 m-0">
                    Looking to sell?
                    <a href="{{ route('register', ['type' => 'seller']) }}" class="text-green-700 hover:text-green-800 font-semibold ml-1 text-decoration-none">
                        Register as Seller &rarr;
                    </a>
                </p>
            </div>

        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-green-600 transition text-decoration-none">
                <span>&larr;</span>
                <span>Back to Home</span>
            </a>
        </div>

    </div>

</body>
</html>