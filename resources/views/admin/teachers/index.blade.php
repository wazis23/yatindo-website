<x-layouts.admin>

<div class="p-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Guru</h1>
            <p class="text-sm text-gray-500">Kelola data guru SMP & SMK</p>
        </div>

        <a href="{{ route('admin.teachers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah Guru
        </a>
    </div>
{{-- ================= FILTER & SEARCH ================= --}}
<div class="bg-white rounded-xl shadow-md p-4 mb-6">

    <form method="GET" class="grid md:grid-cols-5 gap-4 items-end">

        {{-- SEARCH --}}
        <div>
            <label class="text-xs text-gray-500">Cari Nama</label>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Nama guru..."
                   class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>

        {{-- UNIT --}}
        <div>
            <label class="text-xs text-gray-500">Unit</label>
            <select name="unit"
                    class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua</option>
                <option value="smp" {{ request('unit')=='smp'?'selected':'' }}>SMP</option>
                <option value="smk" {{ request('unit')=='smk'?'selected':'' }}>SMK</option>
            </select>
        </div>

        {{-- JABATAN --}}
        <div>
            <label class="text-xs text-gray-500">Jabatan</label>
            <select name="position_id"
                    class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}"
                        {{ request('position_id')==$pos->id?'selected':'' }}>
                        {{ $pos->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- JURUSAN --}}
        <div>
            <label class="text-xs text-gray-500">Jurusan</label>
            <select name="major_id"
                    class="w-full border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}"
                        {{ request('major_id')==$major->id?'selected':'' }}>
                        {{ $major->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-2">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Filter
            </button>

            <a href="{{ route('admin.teachers.index') }}"
               class="bg-gray-200 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">
                Reset
            </a>
        </div>

    </form>

</div>
    {{-- ================= TABLE CARD ================= --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Foto</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Unit</th>
                    <th class="px-4 py-3 text-left">Jabatan</th>
                    <th class="px-4 py-3 text-left">Jurusan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($teachers as $teacher)
                <tr class="hover:bg-gray-50 transition">

                    {{-- FOTO --}}
                    <td class="px-4 py-3">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/'.$teacher->photo) }}"
                                 class="w-12 h-12 rounded-full object-cover shadow">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                        @endif
                    </td>

                    {{-- NAMA --}}
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $teacher->name }}
                        <div class="text-xs text-gray-400">
                            {{ $teacher->subject }}
                        </div>
                    </td>

                    {{-- UNIT --}}
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $teacher->unit == 'smk' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                            {{ strtoupper($teacher->unit) }}
                        </span>
                    </td>

                    {{-- JABATAN --}}
                    <td class="px-4 py-3">
                        {{ $teacher->position->name ?? '-' }}
                    </td>

                    {{-- JURUSAN --}}
                    <td class="px-4 py-3">
                        {{ $teacher->major->name ?? '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center space-x-2">

                        <a href="{{ route('admin.teachers.edit',$teacher) }}"
                           class="px-3 py-1 bg-yellow-400 text-white text-xs rounded hover:bg-yellow-500 transition">
                            Edit
                        </a>

                        <button type="button"
                            onclick="openDeleteModal({{ $teacher->id }}, '{{ $teacher->name }}')"
                            class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">
                            Hapus
                        </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        Belum ada data guru
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $teachers->links() }}
    </div>

</div>


{{-- ================= DELETE MODAL ================= --}}
<div id="deleteModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-96 p-6 animate-scaleIn">

        <h3 class="text-lg font-bold text-gray-800 mb-3">
            Konfirmasi Hapus
        </h3>

        <p id="deleteText" class="text-sm text-gray-600 mb-6"></p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Ya, Hapus
                </button>
            </div>
        </form>

    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>

let deleteId = null;

function openDeleteModal(id, name) {

    deleteId = id;

    document.getElementById('deleteText').innerText =
        `Yakin ingin menghapus "${name}"?`;

    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

document.getElementById("deleteForm").addEventListener("submit", function(e){

    e.preventDefault();

    this.action = "{{ url('admin/teachers') }}/" + deleteId;

    this.submit();
});

</script>


{{-- ================= ANIMATION STYLE ================= --}}
<style>
.animate-scaleIn {
    animation: scaleIn 0.2s ease-out;
}
@keyframes scaleIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>

</x-layouts.admin>