
<section class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-3">
                Kompetensi Keahlian
            </h2>
            <p class="text-gray-500">
                Pilih jurusan sesuai minat dan bakatmu
            </p>
        </div>

        {{-- LOGO MAP --}}
        @php
        $logos = [
            'AKL' => 'images/majors/akl.png',
            'TJKT' => 'images/majors/tjkt.png',
            'TKR' => 'images/majors/tkr.png',
            'TE' => 'images/majors/te.png',
            'TSM' => 'images/majors/tsm.png',
            'TAB' => 'images/majors/tab.png',
        ];
        @endphp

        {{-- GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

            @foreach($majors as $major)

            @php
                $logo = $logos[$major->name] ?? 'images/majors/default.png';
            @endphp

            <a href="{{ route('jurusan.show', $major->id) }}"
               class="group">

                <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center
                            transition duration-300 hover:shadow-xl hover:-translate-y-2 hover:scale-[1.03]">

                    {{-- LOGO --}}
                    <img src="{{ asset($logo) }}"
                         class="w-20 h-20 object-contain mb-4 group-hover:scale-110 transition duration-300">

                    {{-- NAMA --}}
                    <h3 class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 text-center">
                        {{ $major->name }}
                    </h3>

                </div>

            </a>

            @endforeach

        </div>

    </div>

</section>