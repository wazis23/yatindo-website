@props(['route','active'=>false,'icon','label','badge'=>null])

<a href="{{ route($route) }}"
   class="relative group flex items-center justify-between px-4 py-2 rounded-lg transition
   {{ $active ? 'bg-white text-slate-900 font-semibold shadow' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

    <div class="flex items-center gap-3">

        {{-- ICON --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 shrink-0"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            @switch($icon)

                {{-- Dashboard --}}
                @case('home')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9l9-7 9 7v11a2 2 0 01-2 2h-4a2 2 0 01-2-2V9H9v11a2 2 0 01-2 2H3V9z"/>
                @break

                {{-- Posts --}}
                @case('document')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h10M7 11h10M7 15h6"/>
                @break

                {{-- Gallery --}}
                @case('gallery')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5h18v14H3V5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 13l2-2 4 4"/>
                @break

                {{-- Slider --}}
                @case('slider')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                @break

                {{-- Album --}}
                @case('folder')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 7a2 2 0 012-2h3l2 2h9a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                @break

                {{-- Teachers --}}
                @case('users')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m0 0a4 4 0 116 0"/>
                @break

            @endswitch
        </svg>

        {{-- LABEL --}}
        <span x-show="open"
              x-transition
              class="whitespace-nowrap">
            {{ $label }}
        </span>

    </div>

    {{-- BADGE --}}
    @if($badge && $badge > 0)
        <span x-show="open"
              class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
            {{ $badge }}
        </span>
    @endif

    {{-- TOOLTIP --}}
    <div x-show="!open"
         x-transition
         class="absolute left-16 bg-slate-800 text-white text-xs px-2 py-1 rounded
                opacity-0 group-hover:opacity-100 transition pointer-events-none">
        {{ $label }}
    </div>

</a>