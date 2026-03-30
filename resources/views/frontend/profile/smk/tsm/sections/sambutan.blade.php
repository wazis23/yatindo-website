<section class="fade-panel fade-up py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        <div class="grid md:grid-cols-[340px_1fr] gap-16 items-center">

            {{-- FOTO KAPROG --}}
            <div class="text-center md:text-left">

                @if ($kaprog && $kaprog->photo)

                    <img
                        src="{{ asset('storage/'.$kaprog->photo) }}"
                        class="w-72 h-72 object-cover rounded-2xl shadow-xl mx-auto md:mx-0 mb-6"
                    >

                @endif


                {{-- NAMA --}}
                @if ($kaprog)

                    <div class="border-l-4 border-yellow-400 pl-5 inline-block text-left">

                        <h3 class="text-lg font-semibold">
                            {{ $kaprog->name }}
                        </h3>

                        @if ($kaprog->position)

                            <p class="text-gray-500 text-sm">
                                {{ $kaprog->position->name }}
                            </p>

                        @endif

                    </div>

                @endif

            </div>



            {{-- SAMBUTAN --}}
            <div>

                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Sambutan Kepala Program Keahlian
                </h2>

                <div class="w-20 h-1 bg-yellow-400 mb-8"></div>


                <p class="text-gray-600 leading-relaxed mb-6">

                    Selamat datang di program keahlian
                    <strong>{{ $majorTitle }}</strong>
                    SMK Tinta Emas Indonesia.

                    Program Teknik Sepeda Motor (TSM) dirancang untuk membekali siswa 
                    dengan keterampilan dan pengetahuan di bidang otomotif roda dua 
                    yang terus berkembang mengikuti teknologi modern.

                </p>


                <p class="text-gray-600 leading-relaxed mb-6">

                    Siswa akan mempelajari sistem mesin sepeda motor, sistem bahan bakar, 
                    kelistrikan, hingga teknologi injeksi (EFI). Selain itu, siswa dilatih 
                    dalam perawatan, perbaikan, dan diagnosa kerusakan menggunakan alat 
                    modern sesuai standar industri.

                </p>


                <p class="text-gray-600 leading-relaxed mb-6">

                    Kami juga menjalin kerja sama dengan dunia industri otomotif seperti 
                    AHASS (Astra Honda Authorized Service Station), sehingga siswa 
                    mendapatkan pengalaman praktik langsung sesuai kebutuhan dunia kerja.

                </p>


                <p class="text-gray-600 leading-relaxed">

                    Dengan dukungan fasilitas lengkap dan tenaga pengajar profesional, 
                    kami berkomitmen mencetak lulusan yang kompeten, disiplin, dan siap 
                    bekerja maupun berwirausaha di bidang otomotif sepeda motor.

                </p>

            </div>

        </div>

    </div>

</section>