<section class="fade-panel fade-right py-24 bg-gray-50">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-[320px_1fr] gap-10 items-center">

            {{-- FOTO + IDENTITAS --}}
            <div class="text-center md:text-left">

                @if ($principal && $principal->photo)
                    <img
                        src="{{ asset('storage/' . $principal->photo) }}"
                        class="w-72 h-72 object-cover rounded-2xl shadow-xl mx-auto md:mx-0 mb-8"
                    >
                @endif

                @if ($principal)
                    <div class="border-l-4 border-yellow-400 pl-6 inline-block text-left">

                        <h3 class="text-lg font-semibold">
                            {{ $principal->name }}
                        </h3>

                        @if ($principal->position)
                            <p class="text-gray-500 text-sm">
                                {{ $principal->position->name }}
                            </p>
                        @endif

                    </div>
                @endif

            </div>

            {{-- SAMBUTAN --}}
            <div>

                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Sambutan Kepala Sekolah
                </h2>

                <p class="text-gray-600 leading-relaxed mb-6">
                    Selamat datang di SMP Tinta Emas Indonesia. Kami berkomitmen
                    untuk memberikan pendidikan terbaik yang tidak hanya
                    berfokus pada prestasi akademik, tetapi juga pembentukan
                    karakter dan nilai-nilai moral bagi setiap siswa.
                </p>

                <p class="text-gray-600 leading-relaxed">
                    Dengan dukungan tenaga pendidik yang profesional serta
                    lingkungan belajar yang kondusif, kami berharap dapat
                    mencetak generasi yang unggul dan siap menghadapi masa
                    depan.
                </p>

            </div>

        </div>

    </div>

</section>