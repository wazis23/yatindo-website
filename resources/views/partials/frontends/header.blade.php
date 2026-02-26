<!-- HEADER -->
<header id="mainHeader"
class="fixed top-0 w-full z-50 transition-all duration-500">

    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        {{-- LOGO + NAMA --}}
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-tintaemas.png') }}"
                 class="h-10 w-10 object-contain">

            <h1 class="text-sm md:text-lg font-bold text-white">
                YAYASAN TINTA EMAS INDONESIA
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
                    <a href="#">SMP</a>

                    {{-- SMK + SUB --}}
                    <div class="relative group">
                        <a href="#" class="flex justify-between items-center">
                            SMK ▸
                        </a>

                        <div class="dropdown-sub">
						    <a href="#">AKL</a>
                                    <a href="#">TE</a>
                                    <a href="#">TJKT</a>
                                    <a href="#">TKR</a>
                                    <a href="#">TAB</a>
                                    <a href="#">TSM</a>
                        </div>
                    </div>

                    <a href="#">Struktur Yayasan</a>
                </div>
            </div>

            <a href="{{ route('frontend.posts.index') }}" class="nav-link {{ request()->is('berita*') ? 'active-nav' : '' }}">Berita</a>
            <a href="#" class="nav-link">Kontak</a>

        </nav>

        {{-- MOBILE BUTTON --}}
        <button id="menuBtn" class="md:hidden text-white text-2xl">☰</button>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobileMenu" class="hidden md:hidden bg-blue-900 text-white px-6 pb-6 space-y-3 text-sm">
        <a href="/" class="block">Beranda</a>
        <a href="#">Profil</a>
        <a href="{{ route('frontend.posts.index') }}">Berita</a>
        <a href="#">Kontak</a>
    </div>
</header>
