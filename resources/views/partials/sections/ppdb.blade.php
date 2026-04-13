{{-- ===============================
    SECTION CALL TO ACTION PPDB
================================= --}}
<section id="ppdb-section" class="relative py-24 bg-cover bg-center fade-panel transition-all duration-700 ease-out"
         style="background-image: url('{{ asset('images/bg-ppdb.jpg') }}')">

    {{-- Overlay --}}
	
    <div class="absolute inset-0 bg-blue-900/80"></div>

    <div class="relative max-w-5xl mx-auto text-center px-6 text-white">

        {{-- Heading --}}
        <h2 class="text-3xl md:text-5xl font-bold leading-tight mb-6">
            Ayo Bergabung Bersama<br>
            <span class="text-yellow-400">Yayasan Tinta Emas Indonesia</span>
        </h2>

        {{-- Sub --}}
        <p class="text-white/90 text-sm md:text-lg max-w-2xl mx-auto mb-10">
            Wujudkan masa depan terbaik untuk putra-putri Anda bersama pendidikan berkualitas,
            karakter kuat, dan keterampilan siap dunia kerja.
        </p>

        {{-- Buttons --}}
        <div class="flex flex-col sm:flex-row justify-center gap-5">

            {{-- Button Daftar --}}
            <a href="https://ppdb.smp-smktintaemas.sch.id"
               class="bg-yellow-400 text-black font-bold px-8 py-4 rounded-xl shadow-xl hover:scale-105 hover:bg-yellow-300 transition duration-300">
                Daftar PPDB Sekarang
            </a>

            {{-- Button Info --}}
            <a href="#"
               class="border border-white text-white font-semibold px-8 py-4 rounded-xl hover:bg-white hover:text-blue-900 transition duration-300">
                Lihat Informasi PPDB
            </a>

        </div>

        {{-- Extra Note --}}
        <p class="text-white/70 text-xs mt-8">
            Pendaftaran terbuka untuk SMP & SMK • Kuota terbatas
        </p>

    </div>

</section>
