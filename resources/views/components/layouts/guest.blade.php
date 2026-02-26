<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard Admin - SMK Tinta Emas Indonesia</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-800 px-4">

    <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl p-8">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('logo.png') }}" class="h-16 mx-auto mb-4">

            <h2 class="text-xl font-bold text-purple-900">
                Login Dashboard Admin
            </h2>

            <p class="text-sm text-gray-500">
                SMK Tinta Emas Indonesia
            </p>
        </div>

        {{ $slot }}

        <div class="mt-6 text-center text-xs text-gray-400">
            © {{ date('Y') }} Yayasan Tinta Emas Indonesia
        </div>

    </div>

</body>
</html>