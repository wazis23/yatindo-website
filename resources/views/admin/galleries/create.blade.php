<x-layouts.admin>

<h1 class="text-xl font-bold mb-4">Upload Foto Galeri</h1>

<form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Judul kegiatan" class="border p-2 w-full mb-3">

    {{-- KATEGORI GALERI --}}
	<label class="block mb-1 font-semibold">Kategori</label>
	<select name="category" class="border p-2 w-full mb-3 rounded">
    <option value="yayasan">Yayasan</option>
    <option value="sekolah">Sekolah</option>
    <option value="smp">SMP</option>
    <option value="smk">SMK</option>
	</select>
	<select name="album_id" class="border p-2 w-full mb-3">
     @foreach($albums as $album)
    <option value="{{ $album->id }}">{{ $album->title }}</option>
     @endforeach
	</select>
	
	<label class="font-semibold">Pilih Album</label>
	<select name="album_id" class="border p-2 w-full mb-3 rounded">
		@foreach($albums as $album)
			<option value="{{ $album->id }}">{{ $album->title }}</option>
		@endforeach
	</select>
    <input type="file" name="image" class="border p-2 w-full mb-3">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Upload</button>
</form>

</x-layouts.admin>
