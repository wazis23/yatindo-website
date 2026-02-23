<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tinta Emas</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>

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
