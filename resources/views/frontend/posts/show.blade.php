<x-layouts.frontend>
<!-- reading progress bar -->
    <div id="readingProgress"
         class="fixed top-0 left-0 h-1 bg-blue-600 z-50 transition-all duration-150"
        style="width:0%">
    </div>
<!-- HERO -->
<section class="relative">

    @if($post->featured_image)
        <div class="h-[420px] w-full overflow-hidden relative opacity-0 translate-y-6 transition-all duration-700 ease-out"
         id="heroSection">
            <img src="{{ asset('storage/'.$post->featured_image) }}"
                 class="w-full h-full object-cover">
        </div>
    @endif

</section>

<!-- CONTENT WRAPPER -->
<section class="bg-gradient-to-b from-gray-50 to-white py-16 ">

    <div class="max-w-4xl mx-auto px-6">

        <!-- Breadcrumb -->
        <p class="text-sm text-gray-500 mb-4 opacity-0 translate-y-8 transition-all duration-700 ease-out reveal">
            <a href="{{ route('frontend.posts.index') }}"
               class="hover:text-blue-600">
               Berita
            </a>
            /
            {{ $post->title }}
        </p>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4 text-gray-900 opacity-0 translate-y-8 transition-all duration-700 ease-out reveal">
            {{ $post->title }}
        </h1>
        @php
            $wordCount = str_word_count(strip_tags($post->content));
            $readingTime = ceil($wordCount / 200);
        @endphp

        
        <!-- Meta -->
        <div class="flex items-center gap-6 text-sm text-gray-500 mb-10 border-b pb-4 opacity-0 translate-y-8 transition-all duration-700 ease-out reveal">
            <span>
                📅 {{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}
            </span>
            <span>
                ✍ {{ $post->author->name ?? 'Admin' }}
            </span>
            <span>👁 {{ number_format($post->views) }} views</span>
            <span>⏱ {{ $readingTime }} menit baca</span>
        
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl shadow-xl p-10 prose max-w-none text-gray-700 leading-relaxed opacity-0 translate-y-8 transition-all duration-700 ease-out reveal">
            {!! $post->content !!}
        </div>

        <!-- Share + Back -->
        <div class="flex justify-between items-center mt-10">

            <a href="{{ route('frontend.posts.index') }}"
               class="text-blue-600 hover:underline">
               ← Kembali ke Berita
            </a>

        </div>

    </div>

</section>


<!-- FLOATING SHARE ENTERPRISE -->
<div class="fixed right-6 top-1/2 -translate-y-1/2 z-50">

    <div class="relative flex items-center">

        <!-- PLATFORM BUTTONS -->
        <div id="sharePlatforms"
             class="flex items-center gap-3 mr-4">

            <!-- WhatsApp -->
            <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}"
               target="_blank"
               class="share-item hidden-item bg-green-500">
                <!-- WhatsApp SVG -->
                <svg viewBox="0 0 32 32" class="w-5 h-5 fill-white">
                    <path d="M16.001 3C8.82 3 3 8.82 3 16c0 2.82.92 5.42 2.47 7.53L3 29l5.65-2.42A12.93 12.93 0 0016 29c7.18 0 13-5.82 13-13S23.18 3 16 3zm0 23.5c-2.23 0-4.3-.72-6-1.94l-.43-.26-3.36 1.44 1.49-3.27-.28-.45A10.45 10.45 0 015.5 16c0-5.8 4.7-10.5 10.5-10.5S26.5 10.2 26.5 16 21.8 26.5 16 26.5z"/>
                </svg>
            </a>

            <!-- Facebook -->
            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
               target="_blank"
               class="share-item hidden-item bg-blue-600">
                <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white">
                    <path d="M22 12a10 10 0 10-11.63 9.87v-6.99H7.9v-2.88h2.47V9.8c0-2.43 1.45-3.77 3.66-3.77 1.06 0 2.17.19 2.17.19v2.39h-1.22c-1.2 0-1.57.75-1.57 1.52v1.82h2.67l-.43 2.88h-2.24v6.99A10 10 0 0022 12z"/>
                </svg>
            </a>

            <!-- X -->
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
               target="_blank"
               class="share-item hidden-item bg-black">
                <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white">
                    <path d="M22 4.01l-6.75 7.7L22 20h-5.25l-4.5-5.5L7.5 20H2l7.05-8.05L2 4h5.25l4.05 4.95L16.5 4H22z"/>
                </svg>
            </a>

        </div>

        <!-- MAIN BUTTON -->
        <button id="mainShareBtn"
                class="relative w-14 h-14 rounded-full bg-blue-600 text-white
                       flex items-center justify-center
                       shadow-lg transition-all duration-300
                       hover:shadow-[0_0_25px_rgba(59,130,246,0.8)]
                       overflow-hidden">

            <!-- Ripple container -->
            <span class="absolute inset-0 ripple pointer-events-none"></span>

            <!-- Share Icon -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 relative z-10"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 12v.01M12 20l-8-8 8-8M20 12H4"/>
            </svg>

        </button>

    </div>
</div>

<!-- RELATED -->
@if($related->count())
<section class="max-w-6xl mx-auto py-20 px-6">

    <h3 class="text-2xl font-bold mb-10">
        Berita Terkait
    </h3>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($related as $item)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">

            @if($item->featured_image)
                <img src="{{ asset('storage/'.$item->featured_image) }}"
                     class="w-full h-44 object-cover">
            @endif

            <div class="p-6">
                <h4 class="font-semibold text-lg mb-3">
                    {{ $item->title }}
                </h4>

                <a href="{{ route('frontend.posts.show',$item->slug) }}"
                   class="text-blue-600 text-sm font-medium">
                   Baca Selengkapnya →
                </a>
            </div>

        </div>
        @endforeach

    </div>

</section>
@endif

@push('scripts')
<script>
window.addEventListener('scroll', function() {
    const scrollTop = window.scrollY;
    const docHeight = document.body.scrollHeight - window.innerHeight;
    const progress = (scrollTop / docHeight) * 100;
    document.getElementById('readingProgress').style.width = progress + "%";
});
document.addEventListener("DOMContentLoaded", function() {

    const hero = document.getElementById('heroSection');

    setTimeout(() => {
        hero.classList.remove('opacity-0','translate-y-6');
    }, 150); // sedikit delay supaya smooth

    const reveals = document.querySelectorAll('.reveal');

    const observer = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                entry.target.classList.remove('opacity-0','translate-y-8');
                observer.unobserve(entry.target);
            }
        });
    },{
        threshold: 0.15
    });

    reveals.forEach(el => observer.observe(el));

    const btn = document.getElementById('mainShareBtn');
    const items = document.querySelectorAll('#sharePlatforms .share-item');
    const ripple = btn.querySelector('.ripple');

    let open = false;

    btn.addEventListener('click', function(){

        // Ripple effect
        ripple.classList.remove('active');
        void ripple.offsetWidth;
        ripple.classList.add('active');

        open = !open;

        if(open){
            items.forEach((item,index)=>{
                setTimeout(()=>{
                    item.classList.remove('hidden-item');
                    item.classList.add('show-item');
                }, index * 100);
            });
        }else{
            items.forEach((item,index)=>{
                setTimeout(()=>{
                    item.classList.remove('show-item');
                    item.classList.add('hidden-item');
                }, index * 80);
            });
        }

    });


});
</script>
@endpush
</x-layouts.frontend>