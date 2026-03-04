<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="icon"
      type="image/png"
      href="{{ settings('favicon') ? asset('storage/'.settings('favicon')) : asset('favicon.ico') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 h-screen overflow-hidden">

<div x-data="{
        open: localStorage.getItem('sidebarOpen') === 'false' ? false : true,
        toggle() {
            this.open = !this.open;
            localStorage.setItem('sidebarOpen', this.open);
        }
    }"
    class="flex h-full">

    <!-- SIDEBAR -->
    <aside :class="open ? 'w-64' : 'w-20'"
        class="bg-slate-900 text-slate-200 transition-all duration-300 flex flex-col">

        <!-- Logo / Header -->
        <div class="flex items-center justify-between p-4 border-b border-slate-800">

            <div class="flex items-center gap-3">

                <!-- LOGO DYNAMIC -->
                <img src="{{ settings('logo_admin') 
                    ? asset('storage/'.settings('logo_admin')) 
                    : asset('logo.png') }}"
                class="h-10 object-contain">

                <!-- TEXT DYNAMIC -->
                <div x-show="open" class="leading-tight">
                    <div class="font-bold text-sm tracking-wide text-white">
                        {{ settings('site_name') ?? 'Admin Panel' }}
                    </div>
                    <div class="text-xs text-slate-400">
                        {{ settings('school_name') ?? 'Website CMS' }}
                    </div>
                </div>

            </div>

            <!-- TOGGLE -->
            <button @click="toggle()"
                    class="p-2 rounded-lg hover:bg-slate-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

            {{-- DASHBOARD --}}
            @can('view dashboard')
                @php $active = request()->routeIs('admin.dashboard'); @endphp
                <x-admin.nav-item
                    route="admin.dashboard"
                    :active="$active"
                    icon="home"
                    label="Dashboard"
                />
            @endcan


            {{-- POSTS --}}
            @can('manage posts')
                @php
                    $active = request()->routeIs('admin.posts.*');
                    $draftCount = \App\Models\Post::where('status','draft')->count();
                @endphp
                <x-admin.nav-item
                    route="admin.posts.index"
                    :active="$active"
                    icon="document"
                    label="Berita"
                    :badge="$draftCount"
                />
            @endcan


            {{-- SLIDER --}}
            @can('manage sliders')
                @php $active = request()->routeIs('admin.sliders.*'); @endphp
                <x-admin.nav-item
                    route="admin.sliders.index"
                    :active="$active"
                    icon="slider"
                    label="Slider Hero"
                />
            @endcan


            {{-- GALLERY --}}
            @can('manage albums')
                @php $active = request()->routeIs('admin.galleries.*'); @endphp
                <x-admin.nav-item
                    route="admin.galleries.index"
                    :active="$active"
                    icon="gallery"
                    label="Gallery"
                />
            @endcan


            {{-- ALBUM --}}
            @can('manage albums')
                @php $active = request()->routeIs('admin.albums.*'); @endphp
                <x-admin.nav-item
                    route="admin.albums.index"
                    :active="$active"
                    icon="folder"
                    label="Album"
                />
            @endcan


            {{-- TEACHERS --}}
            @can('manage teachers')
                @php $active = request()->routeIs('admin.teachers.*'); @endphp
                <x-admin.nav-item
                    route="admin.teachers.index"
                    :active="$active"
                    icon="users"
                    label="Guru"
                />
            @endcan


            {{-- USERS (SUPER ADMIN ONLY) --}}
            @can('manage users')
                @php $active = request()->routeIs('admin.users.*'); @endphp
                <x-admin.nav-item
                    route="admin.users.index"
                    :active="$active"
                    icon="users-shield"
                    label="Manajemen User"
                />
            @endcan


            {{-- SETTINGS (SUPER ADMIN ONLY) --}}
            @can('manage settings')
                @php $active = request()->routeIs('admin.settings.*'); @endphp
                <x-admin.nav-item
                    route="admin.settings.edit"
                    :active="$active"
                    icon="settings"
                    label="Pengaturan"
                />
            @endcan

        </nav>

       <!-- Logout -->
        <div class="p-3 border-t border-slate-800">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-600 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7"/>

                    </svg>

                    <span x-show="open">Logout</span>

                </button>
            </form>

        </div>

    </aside>
		

   <!-- CONTENT AREA -->
<main class="flex-1 flex flex-col h-screen overflow-hidden">

    {{-- HEADER SLOT --}}
    @isset($header)
        <div class="bg-white border-b shadow-sm sticky top-0 z-40">
            <div class="px-8 py-4 flex justify-between items-center">
                {{ $header }}
            </div>
        </div>
    @endisset

    {{-- CONTENT --}}
    <div class="flex-1 overflow-y-auto p-8 bg-gray-100">
        {{ $slot }}
    </div>

</main>
@stack('scripts')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

</body>
</html>
