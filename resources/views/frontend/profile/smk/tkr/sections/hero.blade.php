<section class="fade-panel fade-up relative pt-24 md:pt-28 pb-20 min-h-[70vh] md:min-h-[75vh] flex items-center justify-center text-white overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0">

        @forelse ($heroSliders as $index => $slider)

            <img
                src="{{ asset('storage/' . $slider->image) }}"
                class="hero-slide absolute inset-0 w-full h-full object-cover {{ $index == 0 ? 'active' : '' }}"
            >

        @empty

            <img
                src="{{ asset('images/default-hero.jpg') }}"
                class="hero-slide active absolute inset-0 w-full h-full object-cover"
            >

        @endforelse

    </div>


    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/60"></div>


    {{-- Content --}}
    <div class="relative z-10 text-center px-4 md:px-6 max-w-4xl mx-auto">

        <h1 class="text-lg md:text-xl font-semibold text-gray-200 mb-4">
            Profil Jurusan
        </h1>

        {{-- Logo Jurusan --}}
        @if($majorLogo)
            <img
                src="{{ asset($majorLogo) }}"
                class="w-32 h-32 md:w-40 md:h-40 mx-auto mb-6 object-contain"
            >
        @endif

        {{-- Nama Jurusan --}}
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-yellow-400 mb-6">
            {{ $majorTitle }}
        </h2>

        <p class="text-base sm:text-lg md:text-xl text-gray-200 mb-8">
            Program keahlian <strong>{{ $majorTitle }}</strong>
            di SMK Tinta Emas Indonesia membekali siswa dengan
            keterampilan perawatan, perbaikan, dan teknologi otomotif modern
            sesuai standar industri.
        </p>


        {{-- 🔥 BUTTON CTA --}}
        <div class="flex justify-center gap-4 flex-wrap">

            {{-- BROSUR --}}
            <a href="#brosur"
               class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105">
                Lihat Brosur
            </a>

            {{-- WHATSAPP --}}
            <a href="https://wa.me/6281380908008?text=Halo%20saya%20ingin%20info%20jurusan%20{{ urlencode($majorTitle) }}"
               target="_blank"
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:scale-105">
                Info Lebih Lanjut
            </a>

        </div>

    </div>

</section>