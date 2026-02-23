<x-layouts.admin>

{{-- HEADER SECTION --}}
<div class="mb-6">

    {{-- Judul besar --}}
    <h1 class="text-3xl font-bold text-gray-800">
        Galeri Kegiatan
    </h1>

    {{-- Subteks --}}
    <p class="text-sm text-gray-500 mt-1">
        Dokumentasi kegiatan sekolah
    </p>

    {{-- Garis pemisah --}}
    <div class="border-b-2 border-gray-200 mt-4"></div>

</div>

{{-- Tombol upload --}}
<a href="{{ route('galleries.create') }}"
   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow mb-6">
    + Upload Foto
</a>

{{-- GRID GALERI --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">

    @foreach($galleries as $item)
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <img src="{{ asset('storage/'.$item->image) }}"
             class="h-40 w-full object-cover">

        <div class="p-3">
            <p class="text-sm font-semibold">{{ $item->title }}</p>
            <p class="text-xs text-gray-500 capitalize">
				{{ $item->category }}
			</p>
            <form method="POST" action="{{ route('galleries.destroy',$item->id) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-xs rounded mt-2">
                    Hapus
                </button>
            </form>
        </div>

    </div>
    @endforeach

</div>


</x-layouts.admin>
