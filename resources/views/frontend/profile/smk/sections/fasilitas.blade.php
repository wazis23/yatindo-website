<section class="fade-panel fade-up py-24 bg-white">

    <div class="container mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Fasilitas Sekolah
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

        </div>


        {{-- GRID --}}
        <div class="grid md:grid-cols-3 gap-10 fasilitas-grid">


            {{-- 01 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/lapangan.jpeg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    01

                </div>

                <h3 class="fasilitas-title">
                    Lapangan
                </h3>

            </div>


            {{-- 02 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/masjid.jpg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    02

                </div>

                <h3 class="fasilitas-title">
                    Masjid
                </h3>

            </div>


            {{-- 03 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/parkiran.jpg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    03

                </div>

                <h3 class="fasilitas-title">
                    Parkiran
                </h3>

            </div>


            {{-- 04 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/perpustakaan.jpeg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    04

                </div>

                <h3 class="fasilitas-title">
                    Perpustakaan
                </h3>

            </div>


            {{-- 05 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/kelas.jpg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    05

                </div>

                <h3 class="fasilitas-title">
                    Kelas
                </h3>

            </div>


            {{-- 06 --}}
            <div class="relative fasilitas-card">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/lab-ipa.jpeg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    06

                </div>

                <h3 class="fasilitas-title">
                    Lab IPA
                </h3>

            </div>


            {{-- 07 CENTER --}}
            <div class="relative fasilitas-card md:col-start-2">

                <div class="card-img overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/smp/fasilitas/lab-komputer.jpeg') }}"
                        class="w-full h-60 object-cover"
                    >

                </div>

                <div class="absolute -top-3 left-3
                            bg-yellow-400 text-white
                            w-10 h-10 flex items-center justify-center
                            text-sm font-bold rounded-md shadow">

                    07

                </div>

                <h3 class="fasilitas-title">
                    Lab Komputer
                </h3>

            </div>


        </div>

    </div>

</section>