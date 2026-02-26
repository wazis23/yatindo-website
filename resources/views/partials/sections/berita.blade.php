{{-- SECTION BERITA TERBARU --}}
<section class="max-w-7xl mx-auto py-12 px-4 bg-white">

    <div class="flex justify-between items-center mb-6 fade-panel transition-all duration-700 ease-out">
        <h2 class="text-2xl font-bold">Berita Terbaru</h2>
        <a href="{{ route('frontend.posts.index') }}" class="text-blue-600 text-sm">
    Lihat Semua </a>
    </div>

    <div class="relative overflow-hidden fade-panel transition-all duration-700 ease-out">

        {{-- Tombol Prev --}}
        <button id="prevNews"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded-full z-20">
            ❮
        </button>

        {{-- Tombol Next --}}
        <button id="nextNews"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded-full z-20">
            ❯
        </button>

        {{-- Wrapper slide --}}
        <div id="newsSlider" class="flex transition-transform duration-700">
            @foreach($posts as $post)
            <div class="min-w-full md:min-w-[33.333%] px-3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">

				{{-- GAMBAR DIPERKECIL --}}
					@if($post->featured_image)
						<img src="{{ asset('storage/'.$post->featured_image) }}"
							class="w-full h-40 object-cover">
						@endif

						<div class="p-4">

						<h3 class="font-semibold text-lg">{{ $post->title }}</h3>

						{{-- DESKRIPSI MAX 3 BARIS --}}
						<p class="text-sm text-gray-600 mt-2 line-clamp-3">
							{{ strip_tags($post->content) }}
						</p>

						<a href="{{ route('frontend.posts.show',$post->slug) }}"
							class="text-blue-600 text-sm mt-3 inline-block">
							Baca Selengkapnya
						</a>

    </div>
</div>

            </div>
            @endforeach
        </div>

    </div>
</section>
