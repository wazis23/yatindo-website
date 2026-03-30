<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Laboratorium TJKT
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">
                Fasilitas laboratorium yang mendukung pembelajaran
                praktik jaringan komputer dan telekomunikasi
                berbasis teknologi industri.
            </p>

        </div>


        {{-- GRID LAB --}}
        <div class="grid md:grid-cols-3 gap-10">

            {{-- LAB 1 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/tjkt/lab-jaringan.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Komputer Jaringan Dasar
                    </h3>

                </div>

            </div>


            {{-- LAB 2 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/tjkt/lab-virtualisasi.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Virtualisasi
                    </h3>

                </div>

            </div>


            {{-- LAB 3 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/tjkt/lab-server.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Server
                    </h3>

                </div>

            </div>

        </div>

    </div>

</section>