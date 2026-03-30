<!-- HEADER -->
<header id="mainHeader"
class="fixed top-0 left-0 w-full z-50 transition-all duration-500">

<div class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex justify-between items-center">

    {{-- LOGO + NAMA --}}
    <div class="flex items-center gap-2 max-w-[70%]">

        <img src="{{ asset('images/logo-tintaemas.png') }}"
             class="h-9 w-9 object-contain">

        <h1 class="font-bold text-white leading-tight truncate">

            {{-- MOBILE --}}
            <span class="md:hidden text-sm">
                YATINDO
            </span>

            {{-- DESKTOP --}}
            <span class="hidden md:inline text-lg">
                YAYASAN TINTA EMAS INDONESIA
            </span>

        </h1>

    </div>

    {{-- DESKTOP MENU --}}
    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-white">

        <a href="/" class="nav-link {{ request()->is('/') ? 'active-nav' : '' }}">Beranda</a>

        {{-- PROFIL DROPDOWN --}}
        <div class="relative group">
            <button class="nav-link flex items-center gap-1">
                Profil ▾
            </button>

            <div class="dropdown">
                <a href="#">Yayasan</a>
                <a href="{{ route('profile.smp') }}">SMP</a>

                {{-- SMK + SUB --}}
                <div class="relative group">
                    <a href="{{ route('profile.smk') }}" class="flex justify-between items-center">
                        SMK ▸
                    </a>

                    <div class="dropdown-sub">
                        <a href="{{ route('profile.major','akl') }}" class="block py-1">
                        AKL
                        </a>

                        <a href="{{ route('profile.major','te') }}" class="block py-1">
                        TE
                        </a>

                        <a href="{{ route('profile.major','tjkt') }}" class="block py-1">
                        TJKT
                        </a>

                        <a href="{{ route('profile.major','tkr') }}" class="block py-1">
                        TKR
                        </a>

                        <a href="{{ route('profile.major','tab') }}" class="block py-1">
                        TAB
                        </a>

                        <a href="{{ route('profile.major','tsm') }}" class="block py-1">
                        TSM
                        </a>
                    </div>
                </div>

                <a href="#">Struktur Yayasan</a>
            </div>
        </div>

        <a href="{{ route('frontend.posts.index') }}" class="nav-link {{ request()->is('berita*') ? 'active-nav' : '' }}">Berita</a>
        <a href="#" class="nav-link">Kontak</a>

    </nav>

    {{-- MOBILE BUTTON --}}
    <button id="menuBtn" class="md:hidden text-white text-2xl">
        ☰
    </button>

</div>

{{-- MOBILE MENU --}}
<div id="mobileMenu" class="hidden md:hidden bg-blue-900 text-white px-6 pb-6 text-sm space-y-2">

    <a href="/" class="block py-2">Beranda</a>

    <!-- PROFIL -->
    <button class="mobile-toggle w-full text-left py-2 flex justify-between items-center">
        Profil
        <span>▾</span>
    </button>

    <div class="mobile-sub hidden pl-4 space-y-2">

        <a href="#" class="block py-1">Yayasan</a>

        <a href="{{ route('profile.smp') }}" class="block py-1">
            SMP
        </a>

        <!-- SMK -->
        <button class="mobile-toggle w-full text-left py-1 flex justify-between items-center">
            SMK
            <span>▾</span>
        </button>

        <div class="mobile-sub hidden pl-6 space-y-2 text-sm">

            <a href="{{ route('profile.smk') }}" class="block py-1 font-semibold">
                Profil SMK
            </a>

            <a href="{{ route('profile.major','akl') }}" class="block py-1">
            AKUNTANSI KEUANGAN LEMBAGA
            </a>

            <a href="{{ route('profile.major','te') }}" class="block py-1">
            TEKNIK ELEKTRONIKA
            </a>

            <a href="{{ route('profile.major','tjkt') }}" class="block py-1">
            TEKNIK JARINGAN KOMPUTER DAN TELEKOMUNIKASI
            </a>

            <a href="{{ route('profile.major','tkr') }}" class="block py-1">
            TEKNIK KENDARAAN RINGAN
            </a>

            <a href="{{ route('profile.major','tab') }}" class="block py-1">
            TEKNIK ALAT BERAT
            </a>

            <a href="{{ route('profile.major','tsm') }}" class="block py-1">
            TEKNIK SEPEDA MOTOR
            </a>
        </div>

        <a href="#" class="block py-1">Struktur Yayasan</a>

    </div>

    <a href="{{ route('frontend.posts.index') }}" class="block py-2">
        Berita
    </a>

    <a href="#" class="block py-2">
        Kontak
    </a>

</div>

</header>