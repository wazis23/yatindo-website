<x-layouts.admin>

<div class="p-6 max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Mata Pelajaran
        </h1>

        <form method="POST"
              action="{{ route('admin.subjects.store') }}"
              class="space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Nama Mata Pelajaran
                </label>
                <input type="text"
                       name="name"
                       required
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- TIPE --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Tipe
                </label>
                <select name="type"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="umum">Umum</option>
                    <option value="produktif">Produktif</option>
                </select>
            </div>

            {{-- UNIT --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Unit
                </label>
                <select name="unit"
                        id="unitSelect"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="smp">SMP</option>
                    <option value="smk">SMK</option>
                </select>
            </div>

            {{-- JURUSAN --}}
            <div id="majorWrapper">
                <label class="block text-sm font-medium mb-1">
                    Jurusan (SMK)
                </label>
                <select name="major_id"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}">
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS --}}
            <div class="md:col-span-2 flex items-center gap-3">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       checked
                       class="w-4 h-4">
                <label class="text-sm">Aktif</label>
            </div>

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-6 border-t">

            <a href="{{ route('admin.subjects.index') }}"
               class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Simpan
            </button>

        </div>

        </form>

    </div>

</div>

{{-- SCRIPT AUTO HIDE JURUSAN --}}
<script>
document.addEventListener("DOMContentLoaded", function(){

    const unitSelect = document.getElementById("unitSelect");
    const majorWrapper = document.getElementById("majorWrapper");

    function toggleMajor(){
        if (unitSelect.value === 'smp') {
            majorWrapper.style.display = 'none';
        } else {
            majorWrapper.style.display = 'block';
        }
    }

    unitSelect.addEventListener('change', toggleMajor);
    toggleMajor();

});
</script>

</x-layouts.admin>