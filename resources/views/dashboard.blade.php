<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - ShopSphere</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="/" class="text-2xl font-bold text-indigo-600">
                ShopSphere
            </a>

            <div class="flex items-center gap-4">

                <span class="text-gray-700">
                    Welcome, {{ auth()->user()->name }}
                </span>

                <form action="/logout" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                    >
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>


    <main class="max-w-7xl mx-auto px-6 py-12">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold text-gray-900">
                Welcome to ShopSphere 🎉
            </h1>

            <p class="text-gray-600 mt-3">
                You are successfully registered and logged in.
            </p>

        </div>

    </main>

</body>
</html>