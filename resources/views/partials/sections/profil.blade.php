{{-- ===============================
    SECTION PROFIL YAYASAN MODERN
================================= --}}
<section class="max-w-7xl mx-auto py-20 px-4 bg-gradient-to-b from-white to-gray-50">

    {{-- ===== PANEL VIDEO SEKOLAH ===== --}}
    <div class="mb-20 fade-panel transition-all duration-700 ease-out">

        <div class="relative rounded-3xl overflow-hidden shadow-2xl group">

            <video autoplay muted loop playsinline
                   class="w-full h-[250px] md:h-[450px] object-cover">
                <source src="{{ asset('videos/video-sekolah.mp4') }}" type="video/mp4">
            </video>

            {{-- Overlay Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-transparent"></div>

            {{-- Text --}}
            <div class="absolute inset-0 flex items-center justify-center">
                <h2 class="text-white text-2xl md:text-4xl font-bold text-center px-4 drop-shadow-lg">
                    SCHOOL FOR STUDY, CREATION, PLAY, AND GROWTH
                </h2>
            </div>

            {{-- Controls muncul saat hover --}}
            <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition duration-500">
                <button onclick="toggleVideo(this)"
                        class="bg-white/20 backdrop-blur-md text-white px-5 py-2 rounded-full border border-white/40 hover:bg-white/30 transition">
                    ⏸ Pause
                </button>
            </div>

        </div>

    </div>


    {{-- ===== PANEL PROFIL YAYASAN ===== --}}
    <div class="grid md:grid-cols-2 gap-16 items-center fade-panel transition-all duration-700 ease-out">

        {{-- KIRI : INFO --}}
        <div class="space-y-6">

            <h2 class="text-3xl md:text-4xl font-bold text-blue-900">
                Yayasan Tinta Emas Indonesia
            </h2>

            {{-- VISI --}}
            <div>
                <h3 class="font-semibold text-gray-800 mb-1">Visi</h3>
                <p class="text-orange-500 font-bold text-lg leading-snug">
                    BERKOMITMEN MEMBERIKAN LAYANAN YANG TERBAIK UNTUK
                    GENERASI MUDA INDONESIA
                </p>
                <p class="font-bold text-gray-500 text-base -mt-1">
                    MUTU TERBAIK PELAYANAN PRIMA
                </p>
            </div>

            {{-- MISI --}}
            <div>
                <h3 class="font-semibold text-gray-800 mb-1">Misi</h3>
                <ul class="text-gray-600 text-sm space-y-1 list-disc pl-5">
                    <li>Menyelenggarakan pendidikan berkualitas.</li>
                    <li>Membentuk karakter disiplin dan berakhlak.</li>
                    <li>Mengembangkan potensi akademik dan non-akademik.</li>
                    <li>Menjalin kerjasama dengan dunia usaha & industri.</li>
                </ul>
            </div>

            {{-- DESKRIPSI --}}
            <p class="text-gray-600 text-sm leading-relaxed">
                Yayasan Tinta Emas Indonesia menaungi SMP dan SMK Tinta Emas
                dengan komitmen tinggi terhadap mutu pendidikan dan pembentukan
                karakter generasi masa depan.
            </p>

            {{-- TOMBOL PROFIL --}}
            <a href="#"
               class="inline-block mt-3 bg-blue-900 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300">
                Lihat Profil Lengkap →
            </a>
        </div>

        {{-- KANAN : FOTO PEMILIK --}}
        <div class="text-center relative">

            <div class="absolute -inset-2 bg-gradient-to-tr from-blue-600 to-yellow-400 rounded-3xl blur-xl opacity-30"></div>

            <img src="{{ asset('images/pemilik-yayasan.jpg') }}"
                 class="relative rounded-3xl shadow-2xl w-80 mx-auto object-cover">

            <h4 class="mt-6 text-lg font-bold text-gray-800">
                Nama Pemilik Yayasan
            </h4>

            <p class="text-sm text-gray-500">
                Founder & Pembina Yayasan
            </p>

        </div>

    </div>

</section>