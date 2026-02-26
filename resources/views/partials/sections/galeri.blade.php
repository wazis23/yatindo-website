{{-- ===== PANEL GALERI KEGIATAN ===== --}}
<section class="max-w-7xl mx-auto py-12 px-4 bg-white">

    <div class="max-w-7xl mx-auto px-4">

        {{-- PANEL --}}
        <div class="bg-gray-50 rounded-3xl shadow-lg p-10 fade-panel transition-all duration-700 ease-out">

            {{-- JUDUL --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Galeri Kegiatan</h2>
                <p class="text-gray-500 text-sm mt-2">Dokumentasi aktivitas sekolah</p>
            </div>
            <div class="flex justify-center gap-4 mb-10">

				<button class="filter-btn px-4 py-2 rounded bg-blue-600 text-white" data-filter="all">Semua</button>
				<button class="filter-btn px-4 py-2 rounded bg-gray-200" data-filter="yayasan">Yayasan</button>
				<button class="filter-btn px-4 py-2 rounded bg-gray-200" data-filter="sekolah">Sekolah</button>
				<button class="filter-btn px-4 py-2 rounded bg-gray-200" data-filter="smp">SMP</button>
				<button class="filter-btn px-4 py-2 rounded bg-gray-200" data-filter="smk">SMK</button>

			</div>

            {{-- GRID FOTO --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

		@foreach($albums as $album)
		<a href="{{ route('albums.show',$album->id) }}"
			class="gallery-item block rounded-xl shadow bg-white overflow-hidden 
       transition-all duration-300 opacity-100 scale-100"
			data-category="{{ strtolower($album->category) }}">
			@php
				$cover = $album->coverPhoto ?? $album->photos->first();
			@endphp


			<img src="{{ $cover ? asset('storage/'.$cover->image) : asset('images/default.jpg') }}"
             class="w-full h-56 object-cover">

			<div class="p-4">
				<h3 class="font-bold">{{ $album->title }}</h3>
				<p class="text-sm text-gray-500 capitalize">{{ $album->category }}</p>
			</div>

		</a>

		@endforeach

		</div>


        </div>

    </div>

</section>
