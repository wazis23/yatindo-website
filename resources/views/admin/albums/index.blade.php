<x-layouts.admin>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Album</h1>
        <p class="text-sm text-gray-500">Kelola album foto kegiatan sekolah</p>
    </div>

    <a href="{{ route('admin.albums.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
        + Album
    </a>
</div>


{{-- CARD TABLE --}}
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <table class="w-full text-sm">

        {{-- HEAD --}}
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="p-4 text-left">Nama Album</th>
                <th class="p-4 text-center">Jumlah Foto</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y">

        @forelse($albums as $album)
            <tr class="hover:bg-gray-50 transition">

                <td class="p-4 font-semibold text-gray-700">
                    {{ $album->title }}
                </td>

                <td class="p-4 text-center">
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                        {{ $album->photos->count() }} Foto
                    </span>
                </td>

                <td class="p-4 text-center space-x-2">

                    <a href="{{ route('admin.albums.show',$album->id) }}"
                       class="px-3 py-1 bg-blue-500 text-white rounded-md text-xs hover:bg-blue-600 transition">
                        Lihat
                    </a>

                    <a href="{{ route('admin.albums.edit',$album->id) }}"
                       class="px-3 py-1 bg-yellow-500 text-white rounded-md text-xs hover:bg-yellow-600 transition">
                        Edit
                    </a>

                    <form action="{{ route('admin.albums.destroy',$album->id) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-red-500 text-white rounded-md text-xs hover:bg-red-600 transition">
                            Hapus
                        </button>
                    </form>

                </td>

            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-6 text-center text-gray-400">
                    Belum ada album dibuat.
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>

</x-layouts.admin>
