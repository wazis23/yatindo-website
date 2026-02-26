<x-layouts.admin>

{{-- ================= HEADER ================= --}}
<div class="mb-10 bg-gradient-to-r from-blue-600 to-indigo-600 
            rounded-2xl p-8 text-white shadow-lg">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

        <div>
            <h1 class="text-3xl font-bold">
                Gallery Management
            </h1>
            <p class="text-sm text-blue-100 mt-1">
                Kelola semua foto dari berbagai album
            </p>
        </div>

        <div class="flex items-center gap-4">

            <div class="text-sm">
                <span class="font-semibold">
                    {{ $photos->total() }}
                </span> Foto
            </div>

            {{-- FILTER --}}
            <form method="GET">
                <div class="relative">
                    <select name="album_id"
                        onchange="this.form.submit()"
                        class="appearance-none bg-white/20 backdrop-blur 
                               border border-white/30 text-white
                               rounded-xl px-5 py-2 pr-10 text-sm
                               focus:ring-2 focus:ring-white/70
                               transition cursor-pointer">

                        <option value="" class="text-black">Semua Album</option>

                        @foreach($albums as $album)
                            <option value="{{ $album->id }}"
                                class="text-black"
                                {{ request('album_id') == $album->id ? 'selected' : '' }}>
                                {{ $album->title }}
                            </option>
                        @endforeach
                    </select>

                    <div class="absolute right-3 top-2.5 pointer-events-none text-white text-xs">
                        ▼
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- ================= BULK ACTION BAR ================= --}}
<div class="mb-6 flex items-center gap-4">

    <button id="toggleSelect"
        class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm transition">
        Mode Pilih
    </button>

    <button id="selectAllBtn"
        class="hidden bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
        Pilih Semua
    </button>

    <form id="bulkForm"
          method="POST"
          action="{{ route('admin.galleries.bulkDelete') }}"
          class="hidden">
        @csrf
        @method('DELETE')

        <input type="hidden" name="ids" id="bulkIds">

        <button type="submit"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition">
            Hapus Terpilih
        </button>
    </form>

</div>



{{-- ================= GRID ================= --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">

@forelse($photos as $photo)

<div class="group relative bg-white rounded-xl shadow-sm overflow-hidden border hover:shadow-lg transition">

    <div class="relative aspect-square overflow-hidden">

        {{-- CHECKBOX --}}
        <div class="absolute top-2 left-2 z-20 hidden selectBox">
            <input type="checkbox"
                   value="{{ $photo->id }}"
                   class="photoCheckbox w-4 h-4">
        </div>

        <img src="{{ asset('storage/'.$photo->image) }}"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-500 cursor-pointer"
             onclick="openPreview('{{ asset('storage/'.$photo->image) }}')">

        {{-- HOVER ACTION --}}
        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100
                    flex flex-col items-center justify-center gap-2 transition">

            <button onclick="openPreview('{{ asset('storage/'.$photo->image) }}')"
                class="bg-white text-black text-xs px-3 py-1 rounded-full">
                Preview
            </button>

            <form method="POST"
                  action="{{ route('admin.galleries.destroy',$photo) }}">
                @csrf
                @method('DELETE')

                <button class="bg-red-600 text-white text-xs px-3 py-1 rounded-full">
                    Hapus
                </button>
            </form>

        </div>

    </div>

    <div class="p-2 text-xs flex justify-between items-center">
        <span class="truncate font-medium text-gray-700">
            {{ $photo->title ?? 'Tanpa Judul' }}
        </span>

        <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full text-[10px]">
            {{ $photo->album->title ?? '-' }}
        </span>
    </div>

</div>

@empty
<div class="col-span-full text-center py-20 text-gray-400">
    Tidak ada foto ditemukan
</div>
@endforelse

</div>


{{-- ================= PAGINATION ================= --}}
<div class="mt-8">
    {{ $photos->withQueryString()->links() }}
</div>



{{-- ================= PREVIEW MODAL ================= --}}
<div id="previewModal"
     class="fixed inset-0 bg-black/90 hidden z-[9999] flex items-center justify-center">

    <button onclick="closePreview()"
        class="absolute top-6 right-8 text-white text-3xl">
        &times;
    </button>

    <img id="previewImage"
         class="max-h-[90vh] max-w-[90vw] object-contain">
</div>


{{-- ================= CONFIRM DELETE MODAL ================= --}}
<div id="confirmModal"
     class="fixed inset-0 bg-black/70 hidden z-[9999] 
            flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md text-center">

        <h2 class="text-lg font-bold text-gray-800 mb-3">
            Konfirmasi Hapus
        </h2>

        <p id="confirmText" class="text-sm text-gray-600 mb-6"></p>

        <div class="flex justify-center gap-4">
            <button onclick="closeConfirm()"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-sm">
                Batal
            </button>

            <button onclick="submitBulkDelete()"
                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm">
                Ya, Hapus
            </button>
        </div>

    </div>
</div>


{{-- ================= TOAST ================= --}}
<div id="toast"
     class="fixed bottom-6 right-6 hidden z-[9999] 
            bg-green-600 text-white px-6 py-3 rounded-xl shadow-xl
            text-sm transition-all duration-300 opacity-0 translate-y-4">
</div>


@push('scripts')
<script>

let selectMode = false;

const toggleBtn = document.getElementById('toggleSelect');
const selectBoxes = document.querySelectorAll('.selectBox');
const checkboxes = document.querySelectorAll('.photoCheckbox');
const selectAllBtn = document.getElementById('selectAllBtn');
const bulkForm = document.getElementById('bulkForm');
const bulkIds = document.getElementById('bulkIds');

toggleBtn.addEventListener('click', () => {
    selectMode = !selectMode;

    selectBoxes.forEach(box => {
        box.classList.toggle('hidden');
    });

    selectAllBtn.classList.toggle('hidden');
    bulkForm.classList.toggle('hidden');

    if (!selectMode) {
        // reset semua checkbox
        checkboxes.forEach(cb => cb.checked = false);
        bulkIds.value = '';
    }

    toggleBtn.innerText = selectMode ? 'Batal Pilih' : 'Mode Pilih';
});


selectAllBtn.addEventListener('click', () => {
    checkboxes.forEach(cb => cb.checked = true);
    updateBulkIds();
});


checkboxes.forEach(cb => {
    cb.addEventListener('change', updateBulkIds);
});

function updateBulkIds() {
    let selected = [];

    checkboxes.forEach(cb => {
        if (cb.checked) selected.push(cb.value);
    });

    bulkIds.value = selected.join(',');
}

function openPreview(src) {
    document.getElementById('previewImage').src = src;
    document.getElementById('previewModal').classList.remove('hidden');
    document.documentElement.style.overflow = 'hidden';
}

function closePreview() {
    document.getElementById('previewModal').classList.add('hidden');
    document.documentElement.style.overflow = '';
}



bulkForm.addEventListener('submit', function(e){
    e.preventDefault();

    let selected = bulkIds.value.split(',').filter(id => id);
    if (selected.length === 0) return;

    let albumName = document.querySelector('select[name="album_id"] option:checked').text;

    document.getElementById('confirmText').innerText =
        `Apakah yakin ingin menghapus ${selected.length} foto pada album "${albumName}" ?`;

    document.getElementById('confirmModal').classList.remove('hidden');
});

function closeConfirm(){
    document.getElementById('confirmModal').classList.add('hidden');
}

function submitBulkDelete(){
    document.getElementById('confirmModal').classList.add('hidden');
    bulkForm.submit();
}



function showToast(message, type = 'success') {

    const toast = document.getElementById('toast');

    toast.innerText = message;

    // warna sesuai type
    if(type === 'success'){
        toast.className =
            "fixed bottom-6 right-6 z-[9999] bg-green-600 text-white px-6 py-3 rounded-xl shadow-xl text-sm transition-all duration-300";
    } else {
        toast.className =
            "fixed bottom-6 right-6 z-[9999] bg-red-600 text-white px-6 py-3 rounded-xl shadow-xl text-sm transition-all duration-300";
    }

    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.remove('opacity-0','translate-y-4');
    }, 10);

    setTimeout(() => {
        toast.classList.add('opacity-0','translate-y-4');
        setTimeout(() => toast.classList.add('hidden'), 300);
    }, 3000);
}

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function(){
    showToast("{{ session('success') }}", 'success');
});
</script>
@endif

@if(session('error'))
<script>
document.addEventListener("DOMContentLoaded", function(){
    showToast("{{ session('error') }}", 'error');
});
</script>
@endif
</script>
@endpush

</x-layouts.admin>