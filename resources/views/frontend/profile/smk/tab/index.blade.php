<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.tab.sections.hero'))
        @include('frontend.profile.smk.tab.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.tab.sections.video'))
        @include('frontend.profile.smk.tab.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.tab.sections.motto'))
        @include('frontend.profile.smk.tab.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.tab.sections.sambutan'))
        @include('frontend.profile.smk.tab.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.tab.sections.guru'))
        @include('frontend.profile.smk.tab.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.tab.sections.fasilitas'))
        @include('frontend.profile.smk.tab.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.tab.sections.karir'))
        @include('frontend.profile.smk.tab.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.tab.sections.gallery'))
        @include('frontend.profile.smk.tab.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.tab.sections.brosur'))
        @include('frontend.profile.smk.tab.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.tab.sections.kontak'))
        @include('frontend.profile.smk.tab.sections.kontak')
    @endif




</x-layouts.frontend>