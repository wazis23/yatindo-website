    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Tinta Emas</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="bg-gray-100 font-sans overflow-x-hidden">

    @include('partials.frontend.header')

    <main>
        @yield('content')
    </main>

    @include('partials.frontend.footer')
    @include('partials.frontend.scripts')
    @include('partials.frontends.back-to-tp')

    @stack('scripts')

    </body>
    </html>
