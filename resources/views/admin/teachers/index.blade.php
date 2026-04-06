<x-layouts.admin>

<div class="p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Guru</h1>
            <p class="text-sm text-gray-500">Kelola data guru SMP & SMK</p>
        </div>

        <a href="{{ route('admin.teachers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Guru
        </a>
    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">

        <form method="GET" class="grid md:grid-cols-5 gap-4 items-end">

            <div>
                <label class="text-xs text-gray-500">Cari Nama</label>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-xs text-gray-500">Unit</label>
                <select name="unit" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    <option value="smp" {{ request('unit')=='smp'?'selected':'' }}>SMP</option>
                    <option value="smk" {{ request('unit')=='smk'?'selected':'' }}>SMK</option>
                </select>
            </div>

            <div>
                <label class="text-xs text-gray-500">Jabatan</label>
                <select name="position_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}"
                            {{ request('position_id')==$pos->id?'selected':'' }}>
                            {{ $pos->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs text-gray-500">Jurusan</label>
                <select name="major_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}"
                            {{ request('major_id')==$major->id?'selected':'' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                    Filter
                </button>

                <a href="{{ route('admin.teachers.index') }}"
                   class="bg-gray-200 px-4 py-2 rounded-lg text-sm">
                    Reset
                </a>
            </div>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Foto</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Mapel</th>
                    <th class="px-4 py-3 text-left">Unit</th>
                    <th class="px-4 py-3 text-left">Jabatan</th>
                    <th class="px-4 py-3 text-left">Jurusan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($teachers as $teacher)
                <tr class="hover:bg-gray-50">

                    {{-- FOTO --}}
                    <td class="px-4 py-3">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/'.$teacher->photo) }}"
                                 class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                        @endif
                    </td>

                    {{-- NAMA --}}
                    <td class="px-4 py-3 font-medium">
                        {{ $teacher->name }}
                    </td>

                    {{-- MAPEL (FIX TOTAL) --}}
                    <td class="px-4 py-3">
                        @if($teacher->subjects && $teacher->subjects->count())

                            <div class="flex flex-wrap gap-1">

                                @foreach($teacher->subjects->take(3) as $s)
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">
                                        {{ $s->name }}
                                    </span>
                                @endforeach

                                @if($teacher->subjects->count() > 3)
                                    <span class="text-xs text-gray-400">
                                        +{{ $teacher->subjects->count() - 3 }}
                                    </span>
                                @endif

                            </div>

                        @else
                            -
                        @endif
                    </td>

                    {{-- UNIT --}}
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $teacher->unit == 'smk'
                                ? 'bg-blue-100 text-blue-600'
                                : 'bg-green-100 text-green-600' }}">
                            {{ strtoupper($teacher->unit) }}
                        </span>
                    </td>

                    {{-- JABATAN --}}
                    <td class="px-4 py-3">
                        {{ $teacher->position->name ?? '-' }}
                    </td>

                    {{-- JURUSAN (FIX MULTI) --}}
                    <td class="px-4 py-3">

                        @if($teacher->majors && $teacher->majors->count())

                            <div class="flex flex-wrap gap-1">
                                @foreach($teacher->majors as $m)
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">
                                        {{ $m->name }}
                                    </span>
                                @endforeach
                            </div>

                        @else
                            -
                        @endif

                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center space-x-2">

                        <a href="{{ route('admin.teachers.edit',$teacher) }}"
                           class="px-3 py-1 bg-yellow-400 text-white text-xs rounded">
                            Edit
                        </a>

                        <button onclick="openDeleteModal({{ $teacher->id }}, '{{ $teacher->name }}')"
                            class="px-3 py-1 bg-red-600 text-white text-xs rounded">
                            Hapus
                        </button>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-400">
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

{{-- DELETE MODAL --}}
<div id="deleteModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl p-6 w-96">

        <h3 class="font-bold mb-3">Konfirmasi Hapus</h3>

        <p id="deleteText" class="mb-6 text-sm"></p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 border rounded-lg">
                    Batal
                </button>

                <button class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Hapus
                </button>
            </div>
        </form>

    </div>
</div>

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

</x-layouts.admin>