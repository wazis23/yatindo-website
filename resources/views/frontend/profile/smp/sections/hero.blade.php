<section class="fade-panel fade-up relative min-h-[75vh] flex items-center justify-center text-white">

    {{-- Background --}}
    <div class="absolute inset-0">
        <img 
        src="{{ asset('images/hero-school.jpg') }}"
        class="w-full h-full object-cover">
    </div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/60"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-6 max-w-4xl">

        <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
            Profil <span class="text-yellow-400">SMP Tinta Emas Indonesia</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-200 mb-8">
            Membentuk generasi yang cerdas, berkarakter, dan berprestasi
            melalui pendidikan berkualitas dan lingkungan belajar yang inspiratif.
        </p>

        <div class="flex justify-center gap-4 flex-wrap">

            <a href="#visi"
            class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-lg font-semibold transition">
                Visi & Misi
            </a>

            <a href="#guru"
            class="border bg-blue-600 border-blue-600 px-6 py-3 rounded-lg hover:bg-white hover:text-black transition">
                Brosur
            </a>

        </div>

    </div>

</section>

{{-- Statistik Sekolah --}}
<section class="fade-panel fade-up bg-white py-10 shadow relative z-20 -mt-10">

<div class="container mx-auto px-6">

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

<div>
<h3 class="text-3xl font-bold text-yellow-500">500+</h3>
<p class="text-gray-600">Siswa</p>
</div>

<div>
<h3 class="text-3xl font-bold text-yellow-500">40+</h3>
<p class="text-gray-600">Guru</p>
</div>

<div>
<h3 class="text-3xl font-bold text-yellow-500">15+</h3>
<p class="text-gray-600">Prestasi</p>
</div>

<div>
<h3 class="text-3xl font-bold text-yellow-500">10+</h3>
<p class="text-gray-600">Fasilitas</p>
</div>

</div>

</div>

</section>