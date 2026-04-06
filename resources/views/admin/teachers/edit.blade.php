<x-layouts.admin>

<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white rounded-2xl shadow-lg p-8">

<h1 class="text-2xl font-bold mb-6">Edit Guru</h1>

<form method="POST"
      action="{{ route('admin.teachers.update',$teacher->id) }}"
      enctype="multipart/form-data"
      id="teacherForm">
@csrf
@method('PUT')

@php
    $selectedSubjects = $teacher->subjects ?? collect();
    $selectedMajors  = $teacher->majors ?? collect();
@endphp

<div class="grid md:grid-cols-2 gap-6">

    {{-- Nama --}}
    <div>
        <label class="text-sm font-medium">Nama</label>
        <input type="text" name="name"
               value="{{ $teacher->name }}"
               class="w-full border rounded-lg px-3 py-2 mt-1">
    </div>

    {{-- Unit --}}
    <div>
        <label class="text-sm font-medium">Unit</label>
        <select name="unit" id="unitField"
                class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="smp" {{ $teacher->unit=='smp'?'selected':'' }}>SMP</option>
            <option value="smk" {{ $teacher->unit=='smk'?'selected':'' }}>SMK</option>
        </select>
    </div>

    {{-- Jenis --}}
    <div>
        <label class="text-sm font-medium">Jenis</label>
        <select name="teacher_type" id="teacherType"
                class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="umum" {{ $teacher->teacher_type=='umum'?'selected':'' }}>Guru Umum</option>
            <option value="produktif" {{ $teacher->teacher_type=='produktif'?'selected':'' }}>Guru Produktif</option>
            <option value="staff" {{ $teacher->teacher_type=='staff'?'selected':'' }}>Staff</option>
        </select>
    </div>

    {{-- Jabatan --}}
    <div>
        <label class="text-sm font-medium">Jabatan</label>
        <select name="position_id"
                class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="">-- Tidak Ada --</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}"
                    {{ $teacher->position_id==$pos->id?'selected':'' }}>
                    {{ $pos->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- MAPEL UMUM --}}
    <div id="subjectWrapper" class="md:col-span-1">
        <label class="text-sm font-medium">Mata Pelajaran</label>

        <div class="border rounded-xl p-3 bg-gray-50 mt-1">

            <input type="text"
                   placeholder="Cari mapel..."
                   class="w-full mb-3 px-3 py-2 border rounded-lg text-sm"
                   onkeyup="filterMapel(this)">

            <div class="max-h-40 overflow-y-auto space-y-2">

                @foreach($subjects as $s)
                    @if($s->type == 'umum')
                        <label class="flex items-center justify-between px-3 py-2 border rounded-lg cursor-pointer hover:bg-blue-50 mapel-item"
                               data-unit="{{ $s->unit }}">

                            <span>{{ $s->name }}</span>

                            <input type="checkbox"
                                   name="subject_ids[]"
                                   value="{{ $s->id }}"
                                   {{ $selectedSubjects->contains($s->id) ? 'checked' : '' }}>
                        </label>
                    @endif
                @endforeach

            </div>

        </div>
    </div>

    <div></div>

</div>

{{-- ================= JURUSAN ================= --}}
<div id="majorWrapper" class="mt-8 hidden">

    <label class="text-sm font-medium mb-2 block">
        Jurusan (SMK)
    </label>

    <div id="majorContainer" class="flex flex-wrap gap-3">

        @foreach($majors as $major)

            @php
                $isSelected = $selectedMajors->contains($major->id);
            @endphp

            <div class="major-item flex items-start gap-2"
                data-id="{{ $major->id }}">

                {{-- INPUT (WAJIB ADA) --}}
                <input type="checkbox"
                    name="majors[]"
                    value="{{ $major->id }}"
                    class="hidden major-input"
                    {{ $isSelected ? 'checked' : '' }}>

                {{-- BUTTON --}}
                <button type="button"
                    class="major-btn px-4 py-2 rounded-lg border transition
                    {{ $isSelected ? 'bg-yellow-400' : 'bg-gray-100' }}"
                    data-id="{{ $major->id }}">
                    {{ $major->name }}
                </button>

                {{-- DROPDOWN --}}
                <div class="mapel-dropdown {{ $isSelected ? '' : 'hidden' }}">
                    <div class="border rounded-lg p-2 bg-gray-50 min-w-[180px] max-h-40 overflow-y-auto">

                        @foreach($subjects as $s)
                            @if($s->major_id == $major->id)
                                <label class="flex items-center justify-between px-2 py-1 text-sm hover:bg-blue-50 rounded">

                                    <span>{{ $s->name }}</span>

                                    <input type="checkbox"
                                        name="subject_ids[]"
                                        value="{{ $s->id }}"
                                        {{ $selectedSubjects->contains($s->id) ? 'checked' : '' }}>
                                </label>
                            @endif
                        @endforeach

                    </div>
                </div>

            </div>

        @endforeach

    </div>

</div>

{{-- FOTO --}}
<div>
    <label class="block text-sm font-medium mb-2">Foto</label>

    {{-- UPLOAD BUTTON --}}
    <div class="flex items-center gap-4 mb-3">

        <label class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
            Pilih Foto
            <input type="file"
                   name="photo"
                   id="photoInput"
                   accept="image/*"
                   class="hidden">
        </label>

        <span id="fileName" class="text-sm text-gray-500">
            Belum ada file dipilih
        </span>

    </div>

    {{-- PREVIEW --}}
    <div id="previewWrapper" class="relative w-32 h-32 hidden">

        <img id="previewImage"
             class="w-32 h-32 rounded-full object-cover shadow">

        {{-- DELETE BUTTON --}}
        <button type="button"
                id="removePhoto"
                class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow">
            ✕
        </button>

    </div>
</div>
@if($teacher->photo)
<script>
document.addEventListener("DOMContentLoaded", function(){

    const previewWrapper = document.getElementById("previewWrapper");
    const previewImage = document.getElementById("previewImage");

    previewWrapper.classList.remove("hidden");
    previewImage.src = "{{ asset('storage/'.$teacher->photo) }}";

});
</script>
@endif
    {{-- FLAG HAPUS --}}
    <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">

</div>

{{-- BUTTON --}}
<div class="flex justify-end gap-3 mt-8">
    <a href="{{ route('admin.teachers.index') }}"
       class="px-4 py-2 border rounded-lg">
       Batal
    </a>

    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg">
        Update
    </button>
</div>

</form>
</div>
</div>

{{-- ================= SCRIPT (SAMA DENGAN CREATE) ================= --}}
<script>

const container = document.getElementById("majorContainer");
const items = Array.from(container.querySelectorAll(".major-item"));
const teacherType = document.getElementById("teacherType");
const unitField = document.getElementById("unitField");
const subjectWrap = document.getElementById("subjectWrapper");
const majorWrap = document.getElementById("majorWrapper");

let selected = [];

document.querySelectorAll(".major-btn").forEach(btn => {
    if(btn.dataset.selected === "1"){
        selected.push(btn.dataset.id);
    }
});

function renderOrder() {

    const selectedItems = items
        .filter(i => selected.includes(i.dataset.id));

    const unselectedItems = items
        .filter(i => !selected.includes(i.dataset.id));

    container.innerHTML = "";

    [...selectedItems, ...unselectedItems].forEach(el => {
        container.appendChild(el);
    });
}

document.querySelectorAll(".major-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        const id = this.dataset.id;
        const item = this.closest(".major-item");
        const input = item.querySelector(".major-input");
        const dropdown = item.querySelector(".mapel-dropdown");

        if (selected.includes(id)) {

            selected = selected.filter(i => i !== id);
            input.checked = false;

            // 🔥 RESET MAPEL DI DALAM JURUSAN INI
            item.querySelectorAll("input[name='subject_ids[]']").forEach(el=>{
                el.checked = false;
            });

            this.classList.remove("bg-yellow-400");
            this.classList.add("bg-gray-100");
            dropdown.classList.add("hidden");

        } else {

            selected.push(id);
            input.checked = true;
            this.classList.remove("bg-gray-100");
            this.classList.add("bg-yellow-400");
            dropdown.classList.remove("hidden");

        }

        renderOrder();
    });

});

function clearAllMapel(){
    document.querySelectorAll("input[name='subject_ids[]']").forEach(el=>{
        el.checked = false;
    });
}
// FILTER MAPEL
function filterMapel(input){
    let val = input.value.toLowerCase();
    document.querySelectorAll(".mapel-item").forEach(el=>{
        el.style.display = el.innerText.toLowerCase().includes(val) ? "flex" : "none";
    });
}

// FILTER UNIT
function filterMapelByUnit(unit){
    document.querySelectorAll(".mapel-item").forEach(el=>{
        el.style.display = (el.dataset.unit === unit) ? "flex" : "none";
    });
}

// FORM LOGIC
function handleForm(){

    if(unitField.value === "smp"){
        teacherType.value = "umum";
        teacherType.querySelector('[value="produktif"]').style.display="none";

        subjectWrap.style.display="block";
        majorWrap.style.display="none";

    }else{

        teacherType.querySelector('[value="produktif"]').style.display="block";

        if(teacherType.value === "produktif"){
            subjectWrap.style.display="none";
            majorWrap.style.display="block";
            clearAllMapel();
        }else{
            subjectWrap.style.display="block";
            majorWrap.style.display="none";
        }
    }

    filterMapelByUnit(unitField.value);
}

// EVENT
teacherType.addEventListener("change", handleForm);
unitField.addEventListener("change", handleForm);

handleForm();

// VALIDASI
document.getElementById("teacherForm").addEventListener("submit", function(e){

    if(teacherType.value === "produktif"){

        if(selected.length === 0){
            alert("Minimal pilih 1 jurusan!");
            e.preventDefault();
        }
    }
});


// preview foto
document.addEventListener("DOMContentLoaded", function(){

    const photoInput = document.getElementById("photoInput");
    const previewImage = document.getElementById("previewImage");
    const previewWrapper = document.getElementById("previewWrapper");
    const removeBtn = document.getElementById("removePhoto");
    const removeInput = document.getElementById("removePhotoInput");
    const fileName = document.getElementById("fileName");

    // =========================
    // PREVIEW FOTO
    // =========================
    photoInput.addEventListener("change", function(e){

        const file = e.target.files[0];

        if(file){
            fileName.textContent = file.name;

            const reader = new FileReader();

            reader.onload = function(event){
                previewImage.src = event.target.result;
                previewWrapper.classList.remove("hidden");
            };

            reader.readAsDataURL(file);

            // reset hapus flag
            removeInput.value = 0;
        }
    });

    // =========================
    // HAPUS FOTO (X BUTTON)
    // =========================
    removeBtn.addEventListener("click", function(){

        previewWrapper.classList.add("hidden");
        previewImage.src = "";
        photoInput.value = "";
        fileName.textContent = "Belum ada file dipilih";

        // tandai untuk dihapus di backend
        removeInput.value = 1;

    });

});
</script>

</x-layouts.admin>