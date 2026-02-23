<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $gallery->title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-16 px-4">

    {{-- Tombol kembali --}}
    <a href="/" class="text-blue-600 text-sm mb-6 inline-block">← Kembali ke Beranda</a>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        {{-- FOTO BESAR --}}
        <img src="{{ asset('storage/'.$gallery->image) }}"
             class="w-full h-[420px] object-cover">

        <div class="p-8">

            {{-- JUDUL --}}
            <h1 class="text-3xl font-bold text-gray-800">
                {{ $gallery->title }}
            </h1>

            {{-- INFO --}}
            <div class="flex gap-4 mt-3 text-sm text-gray-500">
                <span class="capitalize">Kategori: {{ $gallery->category }}</span>
                <span>Diposting: {{ $gallery->created_at->format('d M Y') }}</span>
            </div>

            {{-- DESKRIPSI (sementara statis dulu) --}}
            <p class="mt-6 text-gray-700 leading-relaxed">
                Dokumentasi kegiatan sekolah Tinta Emas Indonesia. 
                Halaman ini nantinya dapat menampilkan banyak foto dalam satu kegiatan, 
                deskripsi acara, serta detail kegiatan lainnya.
            </p>

        </div>

    </div>

</div>

</body>
</html>
