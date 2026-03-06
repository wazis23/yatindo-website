<section class="fade-panel fade-up py-24 bg-gradient-to-r from-blue-950 via-blue-900 to-blue-800 text-white">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-16 items-center">


            {{-- KOLOM BROSUR --}}
            <div class="space-y-8">

                {{-- BROSUR DEPAN --}}
                <div class="brosur-card">

                    <img
                        src="{{ asset('images/smp/brosur/depan.jpg') }}"
                        alt="Brosur SMP Tinta Emas Indonesia"
                    >

                </div>


                {{-- BROSUR BELAKANG --}}
                <div class="brosur-card">

                    <img
                        src="{{ asset('images/smp/brosur/belakang.jpg') }}"
                        alt="Brosur SMP Tinta Emas Indonesia"
                    >

                </div>

            </div>


            {{-- KOLOM INFORMASI --}}
            <div>

                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Penerimaan Murid Baru
                </h2>

                <div class="w-20 h-1 bg-yellow-400 mb-6"></div>

                <p class="text-blue-100 leading-relaxed mb-8">
                    SMP Tinta Emas Indonesia membuka kesempatan bagi
                    calon peserta didik untuk bergabung dalam
                    lingkungan pendidikan yang modern, berkarakter,
                    dan berprestasi.
                </p>


                {{-- BUTTON --}}
                <div class="flex flex-wrap gap-4">

                    {{-- DOWNLOAD BROSUR --}}
                    <a
                        href="{{ asset('brosur/brosur-smp.pdf') }}"
                        target="_blank"
                        rel="noopener"
                        class="btn-brosur">

                        Download Brosur

                    </a>


                    {{-- DAFTAR SPMB --}}
                    <a
                        href="https://ppdb.smp-smktintaemas.sch.id/"
                        target="_blank"
                        rel="noopener"
                        class="btn-spmb">

                        Daftar SPMB
                        <span class="spmb-arrow">→</span>

                    </a>

                </div>

                </div>

            </div>

        </div>

    </div>

</section>