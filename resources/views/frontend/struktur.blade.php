<x-layouts.frontend>

<div class="max-w-7xl mx-auto px-4 py-16">

    {{-- HEADER --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">
            {{ $title }}
        </h1>
        <p class="text-gray-500">
            Struktur Organisasi Resmi
        </p>
    </div>

    {{-- IMAGE --}}
    <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6">

        <img src="{{ asset($image) }}"
            class="w-full rounded-xl shadow object-contain cursor-zoom-in"
            onclick="openImage(this.src)">

    </div>

</div>

</x-layouts.frontend>

<script>
function openImage(src){
    let w = window.open("");
    w.document.write(`<img src="${src}" style="width:100%">`);
}
</script>