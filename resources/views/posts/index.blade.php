<x-layouts.admin>

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Manajemen Berita</h1>

    @can('create posts')
    <a href="{{ route('admin.posts.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        + Tambah Berita
    </a>
    @endcan
</div>

{{-- SUCCESS ALERT --}}
@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- TABEL --}}
<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="w-full text-sm text-left">

<thead class="bg-gray-100 text-gray-700 uppercase text-xs">
<tr>
    <th class="p-3 w-24">Gambar</th>
    <th class="p-3">Judul</th>
    <th class="p-3 text-center">Tanggal</th>
    <th class="p-3 text-center">Aksi</th>
    <th class="p-3 text-center">Status</th>
</tr>
</thead>

<tbody class="divide-y">

@forelse($posts as $post)
<tr class="hover:bg-gray-50 transition">

{{-- Thumbnail --}}
<td class="p-3">
    @if($post->featured_image)
        <img src="{{ asset('storage/'.$post->featured_image) }}"
             class="w-16 h-16 object-cover rounded shadow">
    @else
        <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-xs text-gray-500 rounded">
            No Image
        </div>
    @endif
</td>

{{-- Judul --}}
<td class="p-3 font-medium text-gray-800">
    {{ $post->title }}
</td>



{{-- CREATED DATE --}}
<td class="p-3 text-center text-gray-500">
    {{ $post->created_at->format('d M Y') }}
</td>

{{-- AKSI --}}
<td class="p-3 text-center space-x-2">

    {{-- Publish / Unpublish --}}
    @can('publish posts')

        @if($post->status !== 'published')
            <form method="POST"
                  action="{{ route('admin.posts.publish',$post->id) }}"
                  class="inline">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                    Publish
                </button>
            </form>
        @else
            <form method="POST"
                  action="{{ route('admin.posts.unpublish',$post->id) }}"
                  class="inline">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                    Unpublish
                </button>
            </form>
        @endif

    @endcan

    {{-- Edit --}}
    @can('edit posts')
    <a href="{{ route('admin.posts.edit',$post->id) }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
        Edit
    </a>
    @endcan

    {{-- Delete --}}
    @can('delete posts')
    <form method="POST"
          action="{{ route('admin.posts.destroy',$post->id) }}"
          class="inline">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Yakin hapus berita ini?')"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
            Hapus
        </button>
    </form>
    @endcan

</td>
{{-- STATUS --}}
<td class="p-3 text-center">

    @if($post->status === 'published')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs font-semibold">
            Published
        </span>

        @if($post->published_at)
            <div class="text-[11px] text-gray-500 mt-1">
                {{ $post->published_at->format('d M Y H:i') }}
            </div>
        @endif

    @elseif($post->status === 'unpublished')

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs font-semibold">
            Unpublished
        </span>

    @else

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-xs font-semibold">
            Pending
        </span>

    @endif

</td>
</tr>

@empty
<tr>
<td colspan="5" class="p-6 text-center text-gray-400">
    Belum ada berita
</td>
</tr>
@endforelse

</tbody>
</table>

</div>

</x-layouts.admin>