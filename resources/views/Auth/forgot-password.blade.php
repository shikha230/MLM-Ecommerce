
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <!-- Logo / Heading -->
            <div class="text-center mb-8">

                <a href="/" class="text-3xl font-bold text-indigo-600">
                    ShopSphere
                </a>

                <h1 class="text-2xl font-bold text-gray-900 mt-5">
                    Forgot Password?
                </h1>

                <p class="text-gray-500 mt-2">
                    Enter your registered email and we'll send you a password reset link.
                </p>

            </div>


            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <!-- Success Message -->
                @if (session('status'))

                    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">

                        <p class="text-sm text-green-600">
                            {{ session('status') }}
                        </p>

                    </div>

                @endif


                <!-- Error Messages -->
                @if ($errors->any())

                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">

                        <ul class="text-sm text-red-600 space-y-1">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <!-- Forgot Password Form -->
                <form
                    action="{{ route('password.email') }}"
                    method="POST"
                >

                    @csrf


                    <!-- Email -->
                    <div class="mb-6">

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
                            placeholder="Enter your registered email"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   focus:border-indigo-500
                                   focus:ring-2
                                   focus:ring-indigo-200
                                   outline-none"
                        >

                    </div>


                    <!-- Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600
                               hover:bg-indigo-700
                               text-white
                               font-semibold
                               py-3
                               rounded-lg
                               transition
                               duration-200"
                    >
                        Send Reset Link
                    </button>

                </form>


                <!-- Back to Login -->
                <div class="text-center mt-6">

                    <a
                        href="{{ route('login') }}"
                        class="text-sm text-indigo-600
                               hover:text-indigo-700
                               font-medium"
                    >
                        ← Back to Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>
</html>

