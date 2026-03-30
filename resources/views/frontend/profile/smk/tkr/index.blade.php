<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.tkr.sections.hero'))
        @include('frontend.profile.smk.tkr.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.tkr.sections.video'))
        @include('frontend.profile.smk.tkr.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.tkr.sections.motto'))
        @include('frontend.profile.smk.tkr.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.tkr.sections.sambutan'))
        @include('frontend.profile.smk.tkr.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.tkr.sections.guru'))
        @include('frontend.profile.smk.tkr.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.tkr.sections.fasilitas'))
        @include('frontend.profile.smk.tkr.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.tkr.sections.karir'))
        @include('frontend.profile.smk.tkr.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.tkr.sections.gallery'))
        @include('frontend.profile.smk.tkr.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.tkr.sections.brosur'))
        @include('frontend.profile.smk.tkr.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.tkr.sections.kontak'))
        @include('frontend.profile.smk.tkr.sections.kontak')
    @endif




</x-layouts.frontend>