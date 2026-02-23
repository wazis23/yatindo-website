<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white min-h-screen p-4">

    <h2 class="text-lg font-bold mb-6">Tinta Emas Admin</h2>

    <nav class="space-y-2 text-sm">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="block px-3 py-2 rounded
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800' }}">
           Dashboard
        </a>

        {{-- Berita --}}
        <a href="{{ route('posts.index') }}"
           class="block px-3 py-2 rounded
           {{ request()->routeIs('posts.*') ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800' }}">
           Berita
        </a>

        {{-- Slider --}}
        <a href="{{ route('sliders.index') }}"
           class="block px-3 py-2 rounded
           {{ request()->routeIs('sliders.*') ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800' }}">
           Slider Hero
        </a>

        {{-- Galeri --}}
        <a href="{{ route('galleries.index') }}"
           class="block px-3 py-2 rounded
           {{ request()->routeIs('galleries.*') ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800' }}">
           Galeri Kegiatan
        </a>

        <hr class="border-blue-700 my-4">

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-3 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>

    </nav>
</aside>


    <!-- CONTENT AREA -->
    <main class="flex-1 p-8">
        {{ $slot }}
    </main>
	
	@if(session('success'))
	<div id="toast"
		 class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg animate-slideIn">
		{{ session('success') }}
	</div>

	<script>
	setTimeout(() => {
		document.getElementById('toast').remove();
	}, 3000);
	</script>
	@endif
</body>
</html>
