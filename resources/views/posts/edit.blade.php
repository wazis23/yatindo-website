<x-layouts.admin>

<h1 class="text-xl font-bold mb-4">Edit Berita</h1>

<form method="POST" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Judul</label>
        <input type="text" name="title" value="{{ $post->title }}"
               class="border w-full p-2">
    </div>

    <div class="mt-3">
        <label>Konten</label>
        <textarea name="content" rows="6"
                  class="border w-full p-2">{{ $post->content }}</textarea>
    </div>

    <div class="mt-3">
        <label>Gambar</label>
        <input type="file" name="featured_image" class="border w-full p-2">

        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}"
                 class="w-40 mt-2 rounded">
        @endif
    </div>

    <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
        Update
    </button>
</form>

</x-layouts.admin>
