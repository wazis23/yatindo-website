<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin Tinta Emas
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Total Berita</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            {{ $totalPosts }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Sudah Publish</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $publishedPosts }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Draft</h3>
        <p class="text-3xl font-bold text-red-600 mt-2">
            {{ $draftPosts }}
        </p>
    </div>

</div>
</x-layouts.admin>
