{{-- ===============================
    HALAMAN DETAIL ALBUM (FRONTEND)
================================ --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->title }} - Galeri</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

{{-- HEADER --}}
<header class="bg-blue-900 text-white p-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">YAYASAN TINTA EMAS INDONESIA</h1>
        <nav class="space-x-4">
            <a href="/" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Profil</a>
            <a href="#" class="hover:underline">Berita</a>
            <a href="#" class="hover:underline">Kontak</a>
        </nav>
    </div>
</header>


{{-- PANEL ALBUM --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Panel background --}}
        <div class="bg-white rounded-3xl shadow-lg p-10">

            {{-- Judul album --}}
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $album->title }}
                </h2>

                @if($album->description)
                    <p class="text-gray-500 mt-2">
                        {{ $album->description }}
                    </p>
                @endif
            </div>


            {{-- Grid Foto --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($album->photos as $index => $photo)
                     <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer">

                        {{-- Gambar --}}
                         <img src="{{ asset('storage/'.$photo->image) }}"
							class="w-full h-56 object-cover cursor-zoom-in preview-img"
							data-index="{{ $index }}"
							data-src="{{ asset('storage/'.$photo->image) }}">
                        
						{{-- Overlay judul foto --}}
                        <div class="absolute bottom-0 left-0 w-full bg-black/60 text-white p-2
                                    translate-y-full group-hover:translate-y-0 transition duration-300">
                            <p class="text-sm font-semibold">
                                {{ $photo->title }}
                            </p>
                        </div>

                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        Belum ada foto dalam album ini.
                    </p>
                @endforelse

            </div>

        </div>

    </div>
</section>


{{-- FOOTER --}}
<footer class="bg-gray-900 text-white text-center p-4 mt-10">
    © {{ date('Y') }} Tinta Emas Indonesia School
</footer>
{{-- MODAL PREVIEW --}}
<div id="imageModal"
     class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50">

    <span id="closeModal"
          class="absolute top-5 right-8 text-white text-4xl cursor-pointer">&times;</span>

    <img id="modalImage"
         class="max-h-[90%] max-w-[90%] rounded shadow-lg transition duration-300">
	<button id="prevBtn" class="absolute left-5 text-white text-4xl">❮</button>
	<button id="nextBtn" class="absolute right-5 text-white text-4xl">❯</button>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const closeBtn = document.getElementById('closeModal');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    const images = document.querySelectorAll('.preview-img');
    const sources = Array.from(images).map(img => img.dataset.src);

    let currentIndex = 0;
    let startX = 0;

    function showImage(index) {
        if (index < 0) index = sources.length - 1;
        if (index >= sources.length) index = 0;
        currentIndex = index;
        modalImg.src = sources[currentIndex];
    }

    // Buka modal
    images.forEach(img => {
        img.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            showImage(parseInt(this.dataset.index));
        });
    });

    // Tombol
    prevBtn.onclick = () => showImage(currentIndex - 1);
    nextBtn.onclick = () => showImage(currentIndex + 1);

    // Keyboard
    document.addEventListener('keydown', e => {
        if (modal.classList.contains('hidden')) return;
        if (e.key === 'ArrowLeft') showImage(currentIndex - 1);
        if (e.key === 'ArrowRight') showImage(currentIndex + 1);
        if (e.key === 'Escape') modal.classList.add('hidden');
    });

    // Swipe mobile
    modal.addEventListener('touchstart', e => {
        startX = e.touches[0].clientX;
    });

    modal.addEventListener('touchend', e => {
        let endX = e.changedTouches[0].clientX;
        let diff = startX - endX;

        if (diff > 50) showImage(currentIndex + 1);
        if (diff < -50) showImage(currentIndex - 1);
    });

    // Tutup modal
    closeBtn.onclick = () => modal.classList.add('hidden');
    modal.onclick = (e) => {
        if (e.target === modal) modal.classList.add('hidden');
    };

});
</script>

</body>
</html>
