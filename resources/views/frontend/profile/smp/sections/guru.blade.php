<section class="fade-panel fade-up py-24 bg-white">

    <div class="container mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-10">

            <h2 class="text-3xl font-bold">
                Guru SMP
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

                    <div class="min-w-[220px] text-center select-none">

                        @if ($teacher->photo)
                            <img
                                src="{{ asset('storage/' . $teacher->photo) }}"
                                class="w-40 h-40 object-cover rounded-full mx-auto mb-4 shadow"
                            >
                        @endif

                        <h3 class="font-semibold text-lg">
                            {{ $teacher->name }}
                        </h3>

                        <p class="text-gray-500 text-sm">
                            {{ $teacher->subject ?? 'Guru' }}
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