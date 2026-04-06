<section class="fade-panel fade-up py-24 bg-white">

    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-10">

            <h2 class="text-3xl font-bold">
                Guru Produktif {{ $majorName ?? '' }}
            </h2>

            <div class="flex gap-3">

                <button id="guruPrev"
                    class="w-10 h-10 rounded-full bg-gray-200 hover:bg-yellow-400 transition">
                    ←
                </button>

                <button id="guruNext"
                    class="w-10 h-10 rounded-full bg-gray-200 hover:bg-yellow-400 transition">
                    →
                </button>

            </div>

        </div>


        {{-- SLIDER --}}
        <div class="relative overflow-hidden">

            <div id="guruSlider"
                class="flex gap-8 transition-transform duration-500 ease-in-out">

                @foreach ($teachers as $teacher)

                    <div
                        class="w-[220px] flex-shrink-0 text-center select-none guru-card">

                        {{-- FOTO --}}
                        @if ($teacher->photo)

                            <img
                                src="{{ asset('storage/'.$teacher->photo) }}"
                                class="w-40 h-40 object-cover rounded-full mx-auto mb-4 shadow"
                            >

                        @else

                            <div
                                class="w-40 h-40 bg-gray-200 rounded-full mx-auto mb-4">
                            </div>

                        @endif


                        {{-- NAMA --}}
                        <h3 class="font-semibold text-lg">
                            {{ $teacher->name }}
                        </h3>


                       {{-- MAPEL --}}
                        @php
                            $mapel = $teacher->subjects->pluck('name');
                        @endphp

                        <p class="text-gray-500 text-sm">

                            {{-- tampilkan max 2 --}}
                            {{ $mapel->take(2)->join(', ') }}

                            {{-- kalau lebih dari 2 --}}
                            @if($mapel->count() > 2)
                                +{{ $mapel->count() - 2 }}
                            @endif

                            {{-- fallback --}}
                            @if($mapel->count() == 0)
                                Guru Produktif
                            @endif

                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $teacher->position->name ?? '-' }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- DOTS --}}
        <div id="guruDots"
            class="flex justify-center mt-8 gap-2">
        </div>

    </div>

</section>