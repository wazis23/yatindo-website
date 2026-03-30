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

                    Jurusan ini membekali siswa dengan pengetahuan dan keterampilan di bidang komputer, 
                    jaringan, dan teknologi informasi yang terus berkembang.

                    

                </p>


                <p class="text-gray-600 leading-relaxed">

                    Melalui pembelajaran teori dan praktik, siswa dilatih untuk memahami perakitan komputer,
                    instalasi sistem operasi, konfigurasi jaringan, serta pengelolaan server. 
                    Kami berkomitmen mencetak lulusan yang kompeten, kreatif, dan siap menghadapi dunia kerja
                    maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.

                </p>

            </div>

        </div>

    </div>

</section>