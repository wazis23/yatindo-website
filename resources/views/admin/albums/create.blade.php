<x-layouts.admin>

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Album Kegiatan</h1>
    <p class="text-sm text-gray-500">Buat album baru untuk mengelompokkan foto kegiatan</p>
    <div class="border-b mt-4"></div>
</div>


{{-- FORM CARD --}}
<div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl">

    <form method="POST" action="{{ route('albums.store') }}">
        @csrf

        {{-- Judul Album --}}
        <div class="mb-5">
            <label class="block text-sm font-semibold text-gray-700">
                Judul Kegiatan
            </label>
            <input type="text" name="title"
                   class="mt-1 w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                   placeholder="Contoh: Lomba 17 Agustus">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-5">
            <label class="block text-sm font-semibold text-gray-700">
                Kategori
            </label>
            <select name="category"
                    class="mt-1 w-full border rounded-lg p-3 focus:ring focus:ring-blue-200">
                <option value="">-- Pilih Kategori --</option>
                <option value="yayasan">Yayasan</option>
                <option value="sekolah">Sekolah</option>
                <option value="smp">SMP</option>
                <option value="smk">SMK</option>
            </select>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700">
                Deskripsi Kegiatan
            </label>
            <textarea name="description" rows="4"
                      class="mt-1 w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                      placeholder="Jelaskan kegiatan secara singkat..."></textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center">

            <a href="{{ route('albums.index') }}"
               class="text-gray-500 hover:underline text-sm">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                Simpan Album
            </button>

        </div>

    </form>

</div>

</x-layouts.admin>
