<!-- HERO -->
<!-- HERO SLIDER SECTION -->
@php
$sliders = $sliders ?? collect();
@endphp

<section class="relative w-full h-[300px] md:h-[450px] lg:h-[520px] overflow-hidden">

    @forelse($sliders as $slider)

        {{-- Slide --}}
        <div class="absolute inset-0 slider-item {{ $loop->first ? 'opacity-100 z-10' : 'opacity-0 z-0' }} transition-opacity duration-700">

            {{-- Gambar slider --}}
            <img src="{{ asset('storage/'.$slider->image) }}"
                 class="w-full h-full object-cover object-center">

            {{-- Overlay teks --}}
            <div class="absolute inset-0 bg-blue-900/60 flex items-center justify-center text-white text-center px-4">
                <div>
                    <h2 class="text-2xl md:text-4xl font-bold">
                        SMP & SMK TINTA EMAS INDONESIA
                    </h2>
                    <p class="mt-2">SCHOOL FOR STUDY, CREATION, PLAY, AND GROWTH</p>
                    <span class="mt-3 inline-block bg-yellow-400 text-black px-3 py-1 rounded font-semibold">
                        TERAKREDITASI "A"
                    </span>
                </div>
            </div>

        </div>

    @empty
        <div class="h-full flex items-center justify-center bg-blue-800 text-white">
            Tambahkan slider dari dashboard
        </div>
    @endforelse

</section>