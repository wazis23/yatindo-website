<x-layouts.frontend>

@if(config('frontend.profile.smk.sections.hero'))
@include('frontend.profile.smk.sections.hero')
@endif

@if(config('frontend.profile.smk.sections.jurusan'))
@include('frontend.profile.smk.sections.jurusan')
@endif

@if(config('frontend.profile.smk.sections.video'))
@include('frontend.profile.smk.sections.video')
@endif

@if(config('frontend.profile.smk.sections.sambutan'))
@include('frontend.profile.smk.sections.sambutan')
@endif

@if(config('frontend.profile.smk.sections.visi_misi'))
@include('frontend.profile.smk.sections.visi-misi')
@endif

@if(config('frontend.profile.smk.sections.keunggulan'))
@include('frontend.profile.smk.sections.keunggulan')
@endif

@if(config('frontend.profile.smk.sections.guru'))
@include('frontend.profile.smk.sections.guru')
@endif

@if(config('frontend.profile.smk.sections.fasilitas'))
@include('frontend.profile.smk.sections.fasilitas')
@endif

@if(config('frontend.profile.smk.sections.ekstrakurikuler'))
@include('frontend.profile.smk.sections.ekstrakurikuler')
@endif

@if(config('frontend.profile.smk.sections.brosur'))
@include('frontend.profile.smk.sections.brosur')
@endif

@if(config('frontend.profile.smk.sections.kontak'))
@include('frontend.profile.smk.sections.kontak')
@endif



</x-layouts.frontend>