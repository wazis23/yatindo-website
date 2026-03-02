<x-layouts.admin>

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Album Kegiatan</h1>
    <p class="text-sm text-gray-500">Perbarui data album kegiatan</p>
    <div class="border-b mt-4"></div>
</div>
{{-- SUCCESS ALERT --}}
@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg relative">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
            <button type="button"
                    onclick="this.parentElement.parentElement.remove();"
                    class="text-green-700 hover:text-green-900 text-lg leading-none">
                &times;
            </button>
        </div>
    </div>
@endif
{{-- FORM CARD --}}
<div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl">

    <form method="POST" action="{{ route('admin.albums.update', $album->id) }}">
        @csrf
        @method('PUT')

        {{-- Judul Album --}}
        <div class="mb-5">
            <label class="block text-sm font-semibold text-gray-700">
                Judul Kegiatan
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $album->title) }}"
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

                <option value="yayasan"
                    {{ old('category', $album->category) == 'yayasan' ? 'selected' : '' }}>
                    Yayasan
                </option>

                <option value="sekolah"
                    {{ old('category', $album->category) == 'sekolah' ? 'selected' : '' }}>
                    Sekolah
                </option>

                <option value="smp"
                    {{ old('category', $album->category) == 'smp' ? 'selected' : '' }}>
                    SMP
                </option>

                <option value="smk"
                    {{ old('category', $album->category) == 'smk' ? 'selected' : '' }}>
                    SMK
                </option>

            </select>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700">
                Deskripsi Kegiatan
            </label>

            <textarea name="description"
                      rows="4"
                      class="mt-1 w-full border rounded-lg p-3 focus:ring focus:ring-blue-200"
                      placeholder="Jelaskan kegiatan secara singkat...">{{ old('description', $album->description) }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center">

            <a href="{{ route('admin.albums.index') }}"
               class="text-gray-500 hover:underline text-sm">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                Update Album
            </button>

        </div>

    </form>

</div>

</x-layouts.admin>