<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Kegiatan Siswa AKL
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">
                Dokumentasi kegiatan praktik, pembelajaran, dan aktivitas siswa
                di jurusan {{ $majorTitle }} bidang akuntansi dan keuangan.
            </p>

        </div>


        {{-- GRID GALLERY --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

            {{-- ITEM --}}
            @foreach ([
                'images/akl/1.jpg',
                'images/akl/2.jpg',
                'images/akl/3.jpg',
                'images/akl/4.jpg',
                'images/akl/5.jpg',
                'images/akl/6.jpg'
            ] as $img)

                <div class="gallery-item overflow-hidden rounded-xl shadow cursor-pointer">

                    <img
                        src="{{ asset($img) }}"
                        class="w-full h-64 object-cover transition duration-500 hover:scale-110 gallery-img"
                    >

                </div>

            @endforeach

        </div>

    </div>


    {{-- LIGHTBOX --}}
    <div id="lightbox"
         class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

        <img id="lightboxImg"
             class="max-w-[90%] max-h-[90%] rounded-lg shadow-lg">

    </div>

</section>