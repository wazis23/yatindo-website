<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Berita - Tinta Emas Indonesia</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

<!-- HEADER (SAMA PERSIS DENGAN BERANDA) -->
<header class="bg-blue-900 text-white p-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">YAYASAN TINTA EMAS INDONESIA</h1>
        <nav class="space-x-4">
            <a href="/" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Profil</a>
            <a href="/berita" class="underline">Berita</a>
            <a href="#" class="hover:underline">Kontak</a>
        </nav>
    </div>
</header>

<!-- JUDUL HALAMAN -->
<section class="bg-blue-800 text-white py-14 text-center">
    <h1 class="text-4xl font-bold">Semua Berita Sekolah</h1>
    <p class="text-sm mt-2">Informasi kegiatan & pengumuman terbaru</p>
</section>

<!-- LIST BERITA -->
<section class="max-w-7xl mx-auto py-12 px-4">

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($posts as $post)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition">

            @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}"
                 class="w-full h-52 object-cover">
            @endif

            <div class="p-5">
                <h3 class="text-lg font-bold mb-2">{{ $post->title }}</h3>

                <p class="text-sm text-gray-600">
                    {{ Str::limit(strip_tags($post->content),120) }}
                </p>

                <a href="{{ route('post.show',$post->slug) }}"
                   class="text-blue-600 text-sm mt-3 inline-block font-semibold">
                   Baca Selengkapnya →
                </a>
            </div>
        </div>
        @endforeach

    </div>

    <div class="mt-10">
        {{ $posts->links() }}
    </div>

</section>

<!-- FOOTER (SAMA PERSIS) -->
<footer class="bg-gray-900 text-white text-center p-4 mt-10">
    © {{ date('Y') }} Tinta Emas Indonesia School
</footer>

</body>
</html>
