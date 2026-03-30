<x-layouts.admin>

<div class="p-6 max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Guru
        </h1>

        <form id="teacherForm"
              action="{{ route('admin.teachers.update', $teacher->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text"
                       name="name"
                       value="{{ old('name',$teacher->name) }}"
                       required
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- Unit --}}
            <div>
                <label class="block text-sm font-medium mb-1">Unit</label>
                <select name="unit"
                        id="unitField"
                        class="w-full border rounded-lg px-3 py-2">

                    <option value="smp" {{ $teacher->unit=='smp'?'selected':'' }}>
                        SMP
                    </option>

                    <option value="smk" {{ $teacher->unit=='smk'?'selected':'' }}>
                        SMK
                    </option>

                </select>
            </div>

            {{-- Jenis --}}
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <select name="teacher_type"
                        id="teacherType"
                        class="w-full border rounded-lg px-3 py-2">

                    <option value="umum"
                        {{ $teacher->teacher_type=='umum'?'selected':'' }}>
                        Guru Umum
                    </option>

                    <option value="produktif"
                        {{ $teacher->teacher_type=='produktif'?'selected':'' }}>
                        Guru Produktif
                    </option>

                    <option value="staff"
                        {{ $teacher->teacher_type=='staff'?'selected':'' }}>
                        Staff
                    </option>

                </select>
            </div>

            {{-- Mata Pelajaran --}}
            <div id="subjectWrapper">
                <label class="block text-sm font-medium mb-1">Mata Pelajaran</label>
                <input type="text"
                       name="subject"
                       value="{{ old('subject',$teacher->subject) }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-sm font-medium mb-1">Jabatan</label>
                <select name="position_id"
                        class="w-full border rounded-lg px-3 py-2">

                    <option value="">-- Tidak Ada --</option>

                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}"
                            {{ $teacher->position_id==$pos->id?'selected':'' }}>
                            {{ $pos->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Jurusan --}}
            <div id="majorWrapper">
                <label class="block text-sm font-medium mb-1">Jurusan (SMK)</label>
                <select name="major_id"
                        id="majorField"
                        class="w-full border rounded-lg px-3 py-2">

                    <option value="">-- Tidak Ada --</option>

                    @foreach($majors as $major)
                        <option value="{{ $major->id }}"
                            {{ $teacher->major_id==$major->id?'selected':'' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach

                </select>
            </div>

        </div>

        {{-- FOTO --}}
        <div>
            <label class="block text-sm font-medium mb-2">Foto</label>

            <div class="flex items-center gap-4">

                <label class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                    Pilih Foto
                    <input type="file"
                           name="photo"
                           id="photoInput"
                           accept="image/*"
                           class="hidden">
                </label>

                <span id="fileName" class="text-sm text-gray-500">
                    Ganti foto (opsional)
                </span>

            </div>

            <div class="mt-4">
                <img id="previewImage"
                     src="{{ $teacher->photo ? asset('storage/'.$teacher->photo) : '' }}"
                     class="w-28 h-28 rounded-full object-cover shadow {{ $teacher->photo ? '' : 'hidden' }}">
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-6 border-t">

            <a href="{{ route('admin.teachers.index') }}"
               class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Update
            </button>

        </div>

        <input type="hidden" name="force_replace" id="forceReplace" value="0">

        </form>

    </div>
</div>

{{-- SCRIPT (SAMA DENGAN CREATE) --}}
<script>
document.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("teacherForm");
    const teacherType = document.getElementById("teacherType");
    const unitField = document.getElementById("unitField");
    const majorWrap = document.getElementById("majorWrapper");
    const majorField = document.getElementById("majorField");
    const subjectWrap = document.getElementById("subjectWrapper");
    const photoInput = document.getElementById("photoInput");
    const previewImg = document.getElementById("previewImage");
    const fileName = document.getElementById("fileName");
    const forceReplace = document.getElementById("forceReplace");

    function handleFormLogic(){

        if (unitField.value === "smp") {
            majorWrap.style.display = "none";
            majorField.value = "";
        } else {
            if (teacherType.value === "produktif") {
                majorWrap.style.display = "block";
            } else {
                majorWrap.style.display = "none";
                majorField.value = "";
            }
        }

        if (teacherType.value === "staff") {
            subjectWrap.style.display = "none";
        } else {
            subjectWrap.style.display = "block";
        }
    }

    teacherType.addEventListener("change", handleFormLogic);
    unitField.addEventListener("change", handleFormLogic);
    handleFormLogic();

    photoInput.addEventListener("change", function(e){
        const file = e.target.files[0];

        if(file){
            fileName.textContent = file.name;

            const reader = new FileReader();

            reader.onload = function(event){
                previewImg.src = event.target.result;
                previewImg.classList.remove("hidden");
            };

            reader.readAsDataURL(file);
        }
    });

});
</script>

</x-layouts.admin>