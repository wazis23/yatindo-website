<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        <div class="grid md:grid-cols-2 gap-16 items-center">

            {{-- TEXT --}}
            <div>

                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    {{ $majorTitle }}
                </h2>

                <div class="w-20 h-1 bg-yellow-400 mb-8"></div>

                <p class="text-gray-600 leading-relaxed mb-6">
                    Program keahlian <strong>{{ $majorTitle }}</strong>
                    di SMK Tinta Emas Indonesia membekali siswa dengan
                    keterampilan perawatan, perbaikan, dan teknologi otomotif modern
                    sesuai standar industri.
                </p>

            </div>

            {{-- VIDEO --}}
            <div class="rounded-2xl overflow-hidden shadow-xl">

                <iframe
                    class="w-full h-[300px] md:h-[420px]"
                    src="https://www.youtube.com/embed/FUPQf2_GSts?autoplay=1&mute=0&start=385&end=512"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>

            </div>

        </div>

    </div>

</section>