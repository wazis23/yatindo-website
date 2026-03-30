<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Laboratorium Teknik Elektronika
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">
                Fasilitas laboratorium yang mendukung pembelajaran praktik elektronika,
                mikrokontroler, dan sistem berbasis teknologi industri modern.
            </p>

        </div>


        {{-- GRID LAB --}}
        <div class="grid md:grid-cols-3 gap-10">

            {{-- LAB 1 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/te/lab-elektronika.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Elektronika Dasar
                    </h3>

                </div>

            </div>


            {{-- LAB 2 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/te/lab-mikrokontroler.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Mikrokontroler
                    </h3>

                </div>

            </div>


            {{-- LAB 3 --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/te/lab-iot.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab IoT & Embedded System
                    </h3>

                </div>

            </div>

        </div>

    </div>

</section>