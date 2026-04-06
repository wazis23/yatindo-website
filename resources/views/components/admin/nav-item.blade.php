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
               
                {{-- Manage Users --}}
                @case('users-shield')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4a4 4 0 10-8 0 4 4 0 008 0zm6 0a4 4 0 10-8 0 4 4 0 008 0z"/>
                @break

                {{-- Settings --}}
                @case('settings')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317a9.001 9.001 0 013.35 0l.403 2.176a7.025 7.025 0 012.225 1.286l2.108-.847a9.06 9.06 0 011.675 2.902l-1.694 1.35c.042.247.064.502.064.766s-.022.519-.064.766l1.694 1.35a9.06 9.06 0 01-1.675 2.902l-2.108-.847a7.025 7.025 0 01-2.225 1.286l-.403 2.176a9.001 9.001 0 01-3.35 0l-.403-2.176a7.025 7.025 0 01-2.225-1.286l-2.108.847a9.06 9.06 0 01-1.675-2.902l1.694-1.35A4.98 4.98 0 016 12c0-.264.022-.519.064-.766L4.37 9.884a9.06 9.06 0 011.675-2.902l2.108.847a7.025 7.025 0 012.225-1.286l.403-2.176z"/>
                @break
                
                {{-- Subjects / Mata Pelajaran --}}
                @case('book')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v13m0-13c-1.5-1.333-4.5-2-7-2v13c2.5 0 5.5.667 7 2m0-15c1.5-1.333 4.5-2 7-2v13c-2.5 0-5.5.667-7 2"/>
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