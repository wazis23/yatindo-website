<x-layouts.admin>

<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white rounded-2xl shadow-lg p-8">

<h1 class="text-2xl font-bold mb-6">Tambah Guru</h1>

<form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data" id="teacherForm">
@csrf

{{-- GRID --}}
<div class="grid md:grid-cols-2 gap-6">

    {{-- Nama --}}
    <div>
        <label class="text-sm font-medium">Nama</label>
        <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2 mt-1">
    </div>

    {{-- Unit --}}
    <div>
        <label class="text-sm font-medium">Unit</label>
        <select name="unit" id="unitField" class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="smp">SMP</option>
            <option value="smk">SMK</option>
        </select>
    </div>

    {{-- Jenis --}}
    <div>
        <label class="text-sm font-medium">Jenis</label>
        <select name="teacher_type" id="teacherType" class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="umum">Guru Umum</option>
            <option value="produktif">Guru Produktif</option>
            <option value="staff">Staff</option>
        </select>
    </div>

    {{-- Jabatan --}}
    <div>
        <label class="text-sm font-medium">Jabatan</label>
        <select name="position_id" class="w-full border rounded-lg px-3 py-2 mt-1">
            <option value="">-- Tidak Ada --</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- MAPEL UMUM --}}
    <div id="subjectWrapper">
        <label class="text-sm font-medium">Mata Pelajaran</label>

        <div class="border rounded-xl p-3 bg-gray-50 mt-1">

            <input type="text" placeholder="Cari mapel..."
                   class="w-full mb-3 px-3 py-2 border rounded-lg text-sm"
                   onkeyup="filterMapel(this)">

            <div class="max-h-40 overflow-y-auto space-y-2">

                @foreach($subjects as $s)
                    @if($s->type == 'umum')
                        <label class="flex justify-between px-3 py-2 border rounded-lg mapel-item"
                               data-unit="{{ $s->unit }}">
                            <span>{{ $s->name }}</span>
                            <input type="checkbox" name="subject_ids[]" value="{{ $s->id }}">
                        </label>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    <div></div>

</div>

{{-- JURUSAN --}}
<div id="majorWrapper" class="mt-8 hidden">

<label class="text-sm font-medium mb-3 block">Jurusan (SMK)</label>

<div id="majorContainer" class="flex flex-wrap gap-3">

@foreach($majors as $major)
<div class="major-item flex items-start gap-2"
     data-id="{{ $major->id }}"
     data-order="{{ $loop->index }}">

    <input type="checkbox" name="majors[]" value="{{ $major->id }}" class="hidden major-input">

    <button type="button"
        class="major-btn px-4 py-2 rounded-lg border bg-gray-100"
        data-id="{{ $major->id }}">
        {{ $major->name }}
    </button>

    <div class="mapel-dropdown hidden">

        <div class="border rounded-lg p-2 bg-gray-50 min-w-[180px] max-h-40 overflow-y-auto">

            @foreach($subjects as $s)
                @if($s->major_id == $major->id)
                    <label class="flex justify-between px-2 py-1 text-sm">
                        <span>{{ $s->name }}</span>
                        <input type="checkbox" name="subject_ids[]" value="{{ $s->id }}">
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
<div class="mt-8">
<label class="text-sm font-medium mb-2">Foto</label>

<div class="flex items-center gap-4 mb-3">
<label class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg">
    Pilih Foto
    <input type="file" name="photo" id="photoInput" class="hidden">
</label>
<span id="fileName" class="text-sm text-gray-500">Belum ada file</span>
</div>

<div id="previewWrapper" class="relative w-32 h-32 hidden">
<img id="previewImage" class="w-32 h-32 rounded-full object-cover">
<button type="button" id="removePhoto"
class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 rounded-full">✕</button>
</div>

<input type="hidden" name="remove_photo" id="removePhotoInput" value="0">
</div>

{{-- BUTTON --}}
<div class="flex justify-end gap-3 mt-8">
<button class="bg-blue-600 text-white px-6 py-2 rounded-lg">Simpan</button>
</div>

</form>
</div>
</div>

{{-- SCRIPT --}}
<script>

const teacherType = document.getElementById("teacherType");
const unitField = document.getElementById("unitField");
const subjectWrap = document.getElementById("subjectWrapper");
const majorWrap = document.getElementById("majorWrapper");

const container = document.getElementById("majorContainer");
const items = Array.from(container.querySelectorAll(".major-item"));

let selected = [];

// =========================
// REORDER
// =========================
function renderOrder(){
    const selectedItems = items.filter(i=>selected.includes(i.dataset.id));
    const others = items.filter(i=>!selected.includes(i.dataset.id));
    container.innerHTML="";
    [...selectedItems,...others].forEach(el=>container.appendChild(el));
}

// =========================
// CLICK JURUSAN
// =========================
document.querySelectorAll(".major-btn").forEach(btn=>{
    btn.addEventListener("click", function(){

        let id = this.dataset.id;
        let item = this.closest(".major-item");
        let input = item.querySelector(".major-input");
        let dropdown = item.querySelector(".mapel-dropdown");

        if(selected.includes(id)){
            selected = selected.filter(i=>i!==id);
            input.checked=false;
            this.classList.remove("bg-yellow-400");
            dropdown.classList.add("hidden");
        }else{
            selected.push(id);
            input.checked=true;
            this.classList.add("bg-yellow-400");
            dropdown.classList.remove("hidden");
        }

        renderOrder();
    });
});

// =========================
// FILTER MAPEL
// =========================
function filterMapel(input){
    let val = input.value.toLowerCase();
    document.querySelectorAll(".mapel-item").forEach(el=>{
        el.style.display = el.innerText.toLowerCase().includes(val) ? "flex" : "none";
    });
}

// =========================
// UNIT LOGIC
// =========================
function handleForm(){

    if(unitField.value==="smp"){

        teacherType.value="umum";
        teacherType.querySelector('[value="produktif"]').style.display="none";

        // 🔥 RESET
        clearMajors();

        subjectWrap.style.display="block";
        majorWrap.style.display="none";

    }else{

        teacherType.querySelector('[value="produktif"]').style.display="block";

        if(teacherType.value==="produktif"){

            // 🔥 RESET MAPEL UMUM
            clearAllMapel();

            subjectWrap.style.display="none";
            majorWrap.style.display="block";

        }else{

            // 🔥 RESET MAPEL PRODUKTIF + JURUSAN
            clearAllMapel();
            clearMajors();

            subjectWrap.style.display="block";
            majorWrap.style.display="none";
        }
    }

    // filter mapel by unit
    document.querySelectorAll(".mapel-item").forEach(el=>{
        el.style.display = el.dataset.unit===unitField.value ? "flex" : "none";
    });
}

teacherType.addEventListener("change", handleForm);
unitField.addEventListener("change", handleForm);
handleForm();

// =========================
// VALIDASI
// =========================
document.getElementById("teacherForm").addEventListener("submit", function(e){
    if(teacherType.value==="produktif" && selected.length===0){
        alert("Minimal pilih 1 jurusan!");
        e.preventDefault();
    }
});

// =========================
// FOTO PREVIEW
// =========================
const photoInput = document.getElementById("photoInput");
const previewImage = document.getElementById("previewImage");
const previewWrapper = document.getElementById("previewWrapper");
const removeBtn = document.getElementById("removePhoto");
const removeInput = document.getElementById("removePhotoInput");
const fileName = document.getElementById("fileName");

photoInput.addEventListener("change", function(e){
    const file = e.target.files[0];
    if(file){
        fileName.textContent=file.name;
        let reader=new FileReader();
        reader.onload=e=>{
            previewImage.src=e.target.result;
            previewWrapper.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
        removeInput.value=0;
    }
});

removeBtn.addEventListener("click", function(){
    previewWrapper.classList.add("hidden");
    photoInput.value="";
    removeInput.value=1;
    fileName.textContent="Belum ada file";
});

function clearAllMapel(){
    document.querySelectorAll("input[name='subject_ids[]']").forEach(el=>{
        el.checked = false;
    });
}

function clearMajors(){
    document.querySelectorAll(".major-input").forEach(el=>{
        el.checked = false;
    });

    document.querySelectorAll(".major-btn").forEach(btn=>{
        btn.classList.remove("bg-yellow-400");
        btn.classList.add("bg-gray-100");
    });

    document.querySelectorAll(".mapel-dropdown").forEach(el=>{
        el.classList.add("hidden");
    });

    selected = [];
}
</script>

</x-layouts.admin>