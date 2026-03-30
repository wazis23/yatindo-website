<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.tjkt.sections.hero'))
        @include('frontend.profile.smk.tjkt.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.tjkt.sections.video'))
        @include('frontend.profile.smk.tjkt.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.tjkt.sections.motto'))
        @include('frontend.profile.smk.tjkt.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.tjkt.sections.sambutan'))
        @include('frontend.profile.smk.tjkt.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.tjkt.sections.guru'))
        @include('frontend.profile.smk.tjkt.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.tjkt.sections.fasilitas'))
        @include('frontend.profile.smk.tjkt.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.tjkt.sections.karir'))
        @include('frontend.profile.smk.tjkt.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.tjkt.sections.gallery'))
        @include('frontend.profile.smk.tjkt.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.tjkt.sections.brosur'))
        @include('frontend.profile.smk.tjkt.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.tjkt.sections.kontak'))
        @include('frontend.profile.smk.tjkt.sections.kontak')
    @endif




</x-layouts.frontend>