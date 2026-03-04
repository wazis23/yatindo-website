@props(['title' => 'Tinta Emas Indonesia School'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tinta Emas Indonesia School' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon"
      type="image/png"
      href="{{ settings('favicon') ? asset('storage/'.settings('favicon')) : asset('favicon.ico') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-gray-100 font-sans">

    @include('partials.frontends.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.frontends.footer')
    @include('partials.frontends.back-to-tp')
    @include('partials.frontends.scripts')

    @stack('scripts')

</body>
</html>
