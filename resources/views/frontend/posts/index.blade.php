<x-layouts.frontend title="Berita">

<section class="relative pt-32 pb-20 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">

    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-4xl font-bold mb-4">
            Semua Berita
        </h1>

        <p class="text-blue-100">
            Informasi kegiatan dan pengumuman terbaru sekolah.
        </p>

    </div>
</section>

<section class="bg-gray-50 py-12 max-w-7xl mx-auto px-4">
<form method="GET"
      class="grid md:grid-cols-5 gap-4 mb-10 bg-gray-50 p-6 rounded-2xl shadow-sm">

    <input type="text"
           name="search"
           placeholder="Cari berita..."
           value="{{ request('search') }}"
           class="border px-4 py-2 rounded-lg col-span-2">

    <select name="month" class="border px-4 py-2 rounded-lg">
        <option value="">Semua Bulan</option>
        @for($m=1;$m<=12;$m++)
            <option value="{{ $m }}"
                {{ request('month')==$m?'selected':'' }}>
                {{ date('F', mktime(0,0,0,$m,1)) }}
            </option>
        @endfor
    </select>

    <select name="year" class="border px-4 py-2 rounded-lg">
        <option value="">Semua Tahun</option>
        @foreach($years as $year)
            <option value="{{ $year }}"
                {{ request('year')==$year?'selected':'' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>

    <select name="sort" class="border px-4 py-2 rounded-lg">
        <option value="latest">Terbaru</option>
        <option value="oldest"
            {{ request('sort')=='oldest'?'selected':'' }}>
            Terlama
        </option>
    </select>

    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg">
        Terapkan
    </button>

</form>

<div class="grid md:grid-cols-3 gap-8">

@forelse($posts as $post)

<div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">

@if($post->featured_image)
<img src="{{ asset('storage/'.$post->featured_image) }}"
     class="w-full h-48 object-cover">
@endif

<div class="p-6">

<p class="text-xs text-gray-500 mb-2">
{{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}
</p>

<h2 class="font-semibold text-lg mb-3">
{{ $post->title }}
</h2>

<p class="text-sm text-gray-600 mb-4">
{{ Str::limit(strip_tags($post->content),120) }}
</p>

<a href="{{ route('frontend.posts.show',$post->slug) }}"
   class="text-blue-600 font-medium">
   Baca Selengkapnya →
</a>

</div>
</div>

@empty
<p>Tidak ada berita ditemukan.</p>
@endforelse

</div>

<div class="mt-12">
{{ $posts->withQueryString()->links() }}
</div>

</section>

</x-layouts.frontend>