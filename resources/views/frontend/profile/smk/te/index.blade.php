<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.te.sections.hero'))
        @include('frontend.profile.smk.te.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.te.sections.video'))
        @include('frontend.profile.smk.te.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.te.sections.motto'))
        @include('frontend.profile.smk.te.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.te.sections.sambutan'))
        @include('frontend.profile.smk.te.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.te.sections.guru'))
        @include('frontend.profile.smk.te.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.te.sections.fasilitas'))
        @include('frontend.profile.smk.te.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.te.sections.karir'))
        @include('frontend.profile.smk.te.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.te.sections.gallery'))
        @include('frontend.profile.smk.te.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.te.sections.brosur'))
        @include('frontend.profile.smk.te.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.te.sections.kontak'))
        @include('frontend.profile.smk.te.sections.kontak')
    @endif




</x-layouts.frontend>