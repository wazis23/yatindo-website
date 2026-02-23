<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Berita
        </h2>
    </x-slot>


    <div class="p-6">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label>Judul</label>
                <input type="text" name="title" class="border w-full p-2">
            </div>

            <div class="mt-3">
                <label>Konten</label>
                <textarea name="content" class="border w-full p-2" rows="6"></textarea>
            </div>

            <div class="mt-3">
                <label>Gambar</label>
                <input type="file" name="featured_image" class="border w-full p-2">
            </div>
            <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
