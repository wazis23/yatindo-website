<x-layouts.admin>

    {{-- Header halaman --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Slider Hero</h1>
        <p class="text-sm text-gray-500">Kelola gambar slider halaman depan</p>
    </div>

    {{-- Tombol tambah --}}
    <div class="mb-4">
        <a href="{{ route('sliders.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Tambah Slider
        </a>
    </div>

    {{-- Card tabel --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-sm text-left">

            {{-- Header tabel --}}
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 w-40">Preview</th>
                    <th class="p-4 w-32">Urutan</th>
                    <th class="p-4 w-40">Aksi</th>
                </tr>
            </thead>

            {{-- Isi tabel --}}
            <tbody>

                @forelse($sliders as $slider)
                <tr class="border-t">

                    {{-- Gambar --}}
                    <td class="p-4">
                        <img src="{{ asset('storage/'.$slider->image) }}"
                             class="w-36 h-20 object-cover rounded shadow">
                    </td>

                    {{-- Urutan --}}
                    <td class="p-4 font-semibold">
                        {{ $slider->order_no }}
                    </td>

                    {{-- Tombol hapus --}}
                    <td class="p-4">
                        <form method="POST"
                              action="{{ route('sliders.destroy',$slider->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center p-6 text-gray-500">
                        Belum ada slider
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</x-layouts.admin>
