<x-layouts.frontend>

{{-- ================= HERO SECTION ================= --}}
<section class="relative h-[420px] flex items-center justify-center text-white overflow-hidden">

    @php
        $cover = $album->coverPhoto ?? $album->photos->first();
    @endphp

    @if($cover)
        <img src="{{ asset('storage/'.$cover->image) }}"
             class="absolute inset-0 w-full h-full object-cover">
    @endif

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <div class="relative z-10 text-center px-6 fade-hero">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            {{ $album->title }}
        </h1>

        <p class="text-gray-200 text-sm mb-3 capitalize">
            {{ $album->category }}
        </p>

        <p class="text-sm text-gray-300">
            {{ $album->photos->count() }} Foto
        </p>

        <a href="{{ route('albums.index') }}"
           class="inline-block mt-6 px-6 py-2 bg-white text-black rounded-full shadow hover:scale-105 transition">
           ← Kembali ke Galeri
        </a>
    </div>

</section>



{{-- ================= GALLERY SECTION ================= --}}
@php
    $count = $album->photos->count();
@endphp

<section class="max-w-7xl mx-auto py-20 px-6">

    {{-- SINGLE PHOTO --}}
    @if($count === 1)

        @php $photo = $album->photos->first(); @endphp

        <div class="flex justify-center">
            <div class="max-w-3xl w-full">
                <img src="{{ asset('storage/'.$photo->image) }}"
                     data-full="{{ asset('storage/'.$photo->image) }}"
                     class="gallery-photo w-full rounded-2xl shadow-xl cursor-pointer hover:scale-[1.02] transition duration-500">

                @if($photo->title)
                    <p class="mt-3 text-center text-gray-600 text-sm">
                        {{ $photo->title }}
                    </p>
                @endif
            </div>
        </div>


    {{-- TWO PHOTOS --}}
    @elseif($count === 2)

        <div class="grid md:grid-cols-2 gap-8">

            @foreach($album->photos as $photo)
                <div>
                    <img src="{{ asset('storage/'.$photo->image) }}"
                         data-full="{{ asset('storage/'.$photo->image) }}"
                         class="gallery-photo w-full rounded-2xl shadow cursor-pointer hover:scale-[1.02] transition duration-500">

                    @if($photo->title)
                        <p class="mt-2 text-gray-600 text-sm text-center">
                            {{ $photo->title }}
                        </p>
                    @endif
                </div>
            @endforeach

        </div>


    {{-- MASONRY MODE --}}
    @else

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">

            @foreach($album->photos as $photo)
                <div class="break-inside-avoid opacity-0 translate-y-6 transition duration-700 gallery-item">
                    <img src="{{ asset('storage/'.$photo->image) }}"
                         data-full="{{ asset('storage/'.$photo->image) }}"
                         class="gallery-photo w-full rounded-2xl shadow hover:shadow-2xl cursor-pointer hover:scale-[1.02] transition duration-500">

                    @if($photo->title)
                        <p class="mt-2 text-gray-600 text-sm">
                            {{ $photo->title }}
                        </p>
                    @endif
                </div>
            @endforeach

        </div>

    @endif

</section>
</section>



{{-- ================= LIGHTBOX ================= --}}
<div id="lightbox"
     class="fixed inset-0 hidden z-[99999]
            bg-black/95 backdrop-blur-md
            flex items-center justify-center">

    <button id="closeLightbox"
        class="absolute top-6 right-8 text-white text-4xl z-50">
        &times;
    </button>

    <div id="photoCounter"
        class="absolute top-6 left-8 text-white text-sm bg-black/50 px-4 py-1 rounded-full">
        1 / 1
    </div>

    <button id="prevBtn"
        class="absolute left-8 top-1/2 -translate-y-1/2 text-white text-5xl">
        ❮
    </button>

    <button id="nextBtn"
        class="absolute right-8 top-1/2 -translate-y-1/2 text-white text-5xl">
        ❯
    </button>

    <img id="lightboxImage"
         class="max-h-[90vh] max-w-[90vw] object-contain transition duration-300">
</div>

{{-- ================= SCRIPT ================= --}}
{{-- ================= LIGHTBOX SCRIPT FINAL ================= --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const images = Array.from(document.querySelectorAll('.gallery-photo'));
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const closeBtn = document.getElementById('closeLightbox');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const counter = document.getElementById('photoCounter');

    if (!images.length) return;

    let currentIndex = 0;
    let scale = 1;

    /* ================= OPEN ================= */
    function openLightbox() {
        updateImage();
        lightbox.classList.remove('hidden');
        document.documentElement.classList.add('overflow-hidden');
    }

    /* ================= CLOSE ================= */
    function closeLightbox() {
        lightbox.classList.add('hidden');
        document.documentElement.classList.remove('overflow-hidden');
        scale = 1;
        lightboxImage.style.transform = 'scale(1)';
    }

    /* ================= CLICK IMAGE ================= */
    images.forEach((img, index) => {
        img.addEventListener('click', () => {
            currentIndex = index;
            openLightbox();
        });
    });

    /* ================= UPDATE IMAGE ================= */
    function updateImage() {
        lightboxImage.src = images[currentIndex].dataset.full;
        counter.innerText = (currentIndex + 1) + " / " + images.length;
    }

    /* ================= NEXT / PREV ================= */
    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    }

    nextBtn.addEventListener('click', function(e){
        e.stopPropagation();
        nextImage();
    });

    prevBtn.addEventListener('click', function(e){
        e.stopPropagation();
        prevImage();
    });

    /* ================= CLOSE BUTTON ================= */
    closeBtn.addEventListener('click', closeLightbox);

    /* ================= CLICK BACKGROUND CLOSE ================= */
    lightbox.addEventListener('click', function(e){
        if (e.target === lightbox) closeLightbox();
    });

    /* ================= KEYBOARD SUPPORT ================= */
    document.addEventListener('keydown', function(e){
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === "ArrowRight") nextImage();
            if (e.key === "ArrowLeft") prevImage();
            if (e.key === "Escape") closeLightbox();
        }
    });

    /* ================= SWIPE MOBILE ================= */
    let startX = 0;

    lightbox.addEventListener('touchstart', function(e){
        startX = e.touches[0].clientX;
    });

    lightbox.addEventListener('touchend', function(e){
        let endX = e.changedTouches[0].clientX;
        if (startX - endX > 50) nextImage();
        if (endX - startX > 50) prevImage();
    });

    /* ================= ZOOM WHEEL ================= */
    lightboxImage.addEventListener('wheel', function(e){
        e.preventDefault();

        if (e.deltaY < 0) {
            scale += 0.1;
        } else {
            scale -= 0.1;
        }

        scale = Math.min(Math.max(1, scale), 3);
        lightboxImage.style.transform = `scale(${scale})`;
    });

});
</script>
@endpush

</x-layouts.frontend>