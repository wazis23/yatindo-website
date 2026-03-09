<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="container mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-16">

            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Ekstrakurikuler
            </h2>

            <div class="w-20 h-1 bg-yellow-400 mx-auto"></div>

            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">
                Kegiatan ekstrakurikuler membantu siswa mengembangkan
                bakat, minat, kreativitas, serta karakter melalui
                berbagai aktivitas positif di SMP Tinta Emas Indonesia.
            </p>

        </div>


        {{-- GRID EKSKUL --}}
        <div class="grid md:grid-cols-3 gap-10 ekskul-grid">


            {{-- BASKET --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/basket.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Basket</h3>
                </div>

            </div>


            {{-- VOLLY --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/volly.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Volly</h3>
                </div>

            </div>


            {{-- PASKIBRA --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/paskibra.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Paskibra</h3>
                </div>

            </div>


            {{-- PRAMUKA --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/pramuka.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Pramuka</h3>
                </div>

            </div>


            {{-- SENI MUSIK --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/musik.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Seni Musik</h3>
                </div>

            </div>


            {{-- SENI TARI --}}
            <div class="ekskul-card">

                <img
                    src="{{ asset('images/smp/ekskul/tari.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Seni Tari</h3>
                </div>

            </div>


            {{-- FUTSAL (CENTER) --}}
            <div class="ekskul-card md:col-start-2">

                <img
                    src="{{ asset('images/smp/ekskul/futsal.jpg') }}"
                    class="ekskul-img"
                >

                <div class="ekskul-overlay">
                    <h3>Futsal</h3>
                </div>

            </div>


        </div>

    </div>

</section>