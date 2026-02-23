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
        {{-- ===== MENU ALBUM ===== --}}
		<a href="{{ route('albums.index') }}"
			class="flex items-center gap-2 px-4 py-2 rounded-lg transition
			{{ request()->routeIs('albums.*') ? 'bg-white text-blue-700 font-semibold shadow' : 'text-white hover:bg-blue-700' }}">

		{{-- Icon folder --}}
		<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
			fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 7a2 2 0 012-2h3l2 2h9a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
		</svg>

		Album
	</a>
	{{-- teachers --}}
	<a href="{{ route('teachers.index') }}"
   class="flex items-center gap-2 px-3 py-2 rounded
   {{ request()->routeIs('teachers.*') ? 'bg-blue-700 font-semibold' : 'hover:bg-blue-800' }}">
    
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 14l9-5-9-5-9 5 9 5z"/>
    </svg>

    <span>Daftar Guru</span>
</a>
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

</body>
</html>
