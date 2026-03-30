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

                    Program keahlian Teknik Kendaraan Ringan (TKR) dirancang untuk membekali siswa 
                    dengan pengetahuan, keterampilan, dan sikap profesional di bidang otomotif, 
                    khususnya dalam perawatan dan perbaikan kendaraan ringan yang terus berkembang 
                    mengikuti kemajuan teknologi.

                </p>


                <p class="text-gray-600 leading-relaxed mb-6">

                    Melalui pembelajaran berbasis teori dan praktik, siswa akan mempelajari berbagai 
                    kompetensi seperti sistem mesin, sistem kelistrikan, sistem pemindah tenaga, 
                    chassis, serta teknologi kendaraan modern berbasis injeksi dan digital. 
                    Siswa juga dilatih menggunakan alat diagnostik, melakukan perawatan berkala, 
                    serta mampu menganalisis dan memperbaiki kerusakan kendaraan secara tepat.

                </p>


                <p class="text-gray-600 leading-relaxed mb-6">

                    Kami juga mengembangkan kerja sama dengan dunia industri, salah satunya melalui 
                    program <strong>Pintar Bersama Daihatsu</strong>, sehingga siswa mendapatkan 
                    pengalaman belajar yang selaras dengan kebutuhan industri otomotif saat ini. 
                    Hal ini memberikan peluang lebih besar bagi siswa untuk siap kerja, magang, 
                    maupun berkarir di perusahaan otomotif ternama.

                </p>


                <p class="text-gray-600 leading-relaxed">

                    Dengan dukungan tenaga pengajar profesional, fasilitas praktik yang memadai, 
                    serta kurikulum berbasis industri, kami berkomitmen mencetak lulusan yang kompeten, 
                    disiplin, berkarakter, dan siap bersaing di dunia kerja maupun berwirausaha 
                    di bidang otomotif.

                </p>

            </div>

        </div>

    </div>

</section>