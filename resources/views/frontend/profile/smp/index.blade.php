<x-layouts.frontend>

@if(config('frontend.profile.smp.sections.hero'))
@include('frontend.profile.smp.sections.hero')
@endif

@if(config('frontend.profile.smp.sections.video'))
@include('frontend.profile.smp.sections.video')
@endif

@if(config('frontend.profile.smp.sections.sambutan'))
@include('frontend.profile.smp.sections.sambutan')
@endif

@if(config('frontend.profile.smp.sections.visi_misi'))
@include('frontend.profile.smp.sections.visi-misi')
@endif

@if(config('frontend.profile.smp.sections.keunggulan'))
@include('frontend.profile.smp.sections.keunggulan')
@endif

@if(config('frontend.profile.smp.sections.guru'))
@include('frontend.profile.smp.sections.guru')
@endif

@if(config('frontend.profile.smp.sections.fasilitas'))
@include('frontend.profile.smp.sections.fasilitas')
@endif

@if(config('frontend.profile.smp.sections.ekstrakurikuler'))
@include('frontend.profile.smp.sections.ekstrakurikuler')
@endif

@if(config('frontend.profile.smp.sections.brosur'))
@include('frontend.profile.smp.sections.brosur')
@endif




</x-layouts.frontend>