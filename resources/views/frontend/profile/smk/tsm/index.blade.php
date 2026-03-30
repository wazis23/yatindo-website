<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.tsm.sections.hero'))
        @include('frontend.profile.smk.tsm.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.tsm.sections.video'))
        @include('frontend.profile.smk.tsm.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.tsm.sections.motto'))
        @include('frontend.profile.smk.tsm.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.tsm.sections.sambutan'))
        @include('frontend.profile.smk.tsm.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.tsm.sections.guru'))
        @include('frontend.profile.smk.tsm.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.tsm.sections.fasilitas'))
        @include('frontend.profile.smk.tsm.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.tsm.sections.karir'))
        @include('frontend.profile.smk.tsm.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.tsm.sections.gallery'))
        @include('frontend.profile.smk.tsm.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.tsm.sections.brosur'))
        @include('frontend.profile.smk.tsm.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.tsm.sections.kontak'))
        @include('frontend.profile.smk.tsm.sections.kontak')
    @endif




</x-layouts.frontend>