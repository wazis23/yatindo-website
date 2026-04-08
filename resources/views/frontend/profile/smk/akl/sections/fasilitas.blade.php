<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Laboratorium AKL
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">
                Fasilitas laboratorium yang mendukung pembelajaran praktik akuntansi
                secara manual, berbasis komputer, serta simulasi layanan perbankan.
            </p>

        </div>


        {{-- GRID LAB --}}
        <div class="grid md:grid-cols-2 gap-10">

            {{-- LAB AKL --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/smk/fasilitas/lab-akl.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Lab Akuntansi (Manual & Komputer)
                    </h3>

                </div>

            </div>


            {{-- BANK MINI --}}
            <div class="relative group rounded-xl overflow-hidden shadow-lg">

                <img
                    src="{{ asset('images/smk/fasilitas/bank-mini.jpg') }}"
                    class="w-full h-64 object-cover group-hover:scale-110 transition duration-500"
                >

                <div class="absolute inset-0 bg-black/40 flex items-end">

                    <h3 class="text-white text-lg font-semibold p-6">
                        Bank Mini
                    </h3>

                </div>

            </div>

        </div>

    </div>

</section>