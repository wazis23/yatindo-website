<x-layouts.frontend>

    {{-- HERO --}}
    @if(config('frontend.majors.akl.sections.hero'))
        @include('frontend.profile.smk.akl.sections.hero')
    @endif


    {{-- VIDEO PROFIL JURUSAN --}}
    @if(config('frontend.majors.akl.sections.video'))
        @include('frontend.profile.smk.akl.sections.video')
    @endif


    {{-- MOTTO & KEUNGGULAN --}}
    @if(config('frontend.majors.akl.sections.motto'))
        @include('frontend.profile.smk.akl.sections.motto')
    @endif


    {{-- SAMBUTAN KEPALA PROGRAM --}}
    @if(config('frontend.majors.akl.sections.sambutan'))
        @include('frontend.profile.smk.akl.sections.sambutan')
    @endif


    {{-- GURU PRODUKTIF & TOOLMAN --}}
    @if(config('frontend.majors.akl.sections.guru'))
        @include('frontend.profile.smk.akl.sections.guru')
    @endif


    {{-- FASILITAS JURUSAN --}}
    @if(config('frontend.majors.akl.sections.fasilitas'))
        @include('frontend.profile.smk.akl.sections.fasilitas')
    @endif


    {{-- KARIR LULUSAN --}}
    @if(config('frontend.majors.akl.sections.karir'))
        @include('frontend.profile.smk.akl.sections.karir')
    @endif

    {{-- GALERI --}}
    @if(config('frontend.majors.akl.sections.gallery'))
        @include('frontend.profile.smk.akl.sections.gallery')
    @endif

     {{-- BROSUR --}}
    @if(config('frontend.majors.akl.sections.brosur'))
        @include('frontend.profile.smk.akl.sections.brosur')
    @endif

    {{-- KONTAK --}}
    @if(config('frontend.majors.akl.sections.kontak'))
        @include('frontend.profile.smk.akl.sections.kontak')
    @endif




</x-layouts.frontend>