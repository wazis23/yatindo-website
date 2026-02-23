<x-layouts.admin>

<div class="p-6 max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Tambah Guru
        </h1>

        <form id="teacherForm" action="{{ route('teachers.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text"
                       name="name"
                       required
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            {{-- Unit --}}
            <div>
                <label class="block text-sm font-medium mb-1">Unit</label>
                <select name="unit"
                        id="unitField"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="smp">SMP</option>
                    <option value="smk">SMK</option>
                </select>
            </div>

            {{-- Jenis --}}
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <select name="teacher_type"
                        id="teacherType"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="umum">Guru Umum</option>
                    <option value="produktif">Guru Produktif</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            {{-- Mata Pelajaran --}}
            <div id="subjectWrapper">
                <label class="block text-sm font-medium mb-1">Mata Pelajaran</label>
                <input type="text"
                       name="subject"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-sm font-medium mb-1">Jabatan</label>
                <select name="position_id"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}">
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
                        <option value="{{ $major->id }}">
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- FOTO MODERN --}}
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
                    Belum ada file dipilih
                </span>

            </div>

            <div class="mt-4">
                <img id="previewImage"
                     class="w-28 h-28 rounded-full object-cover shadow hidden">
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-6 border-t">
            <a href="{{ route('teachers.index') }}"
               class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>

            <button type="submit"
				class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
				Simpan
			</button>
        </div>
        <input type="hidden" name="force_replace" id="forceReplace" value="0">
        </form>

    </div>
</div>

<div id="replaceModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-96 p-6 animate-scaleIn">

        <h3 class="text-lg font-bold mb-4 text-gray-800">
            Jabatan Sudah Digunakan
        </h3>

        <div id="existingInfo" class="mb-4"></div>

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()"
                class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                Batal
            </button>

            <button onclick="confirmReplace()"
                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Ya, Ganti
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT INLINE SUPAYA PASTI JALAN --}}
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

    // ========================
    // FORM LOGIC
    // ========================
    function handleFormLogic() {

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

    // ========================
    // PHOTO PREVIEW
    // ========================
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

    // ========================
    // AJAX CHECK POSITION
    // ========================
    form.addEventListener("submit", function(e){

        const positionId = form.querySelector("[name='position_id']").value;

        if (!positionId) return;

        e.preventDefault();

        fetch("{{ route('teachers.checkPosition') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                position_id: positionId
            })
        })
        .then(res => res.json())
        .then(data => {

            if (data.status === "conflict") {

                const photoHTML = data.teacher.photo
                    ? '<img src="/storage/' + data.teacher.photo + '" class="w-14 h-14 rounded-full object-cover">'
                    : '<div class="w-14 h-14 bg-gray-300 rounded-full"></div>';

                document.getElementById("existingInfo").innerHTML =
                    '<div class="flex items-center gap-3">' +
                        photoHTML +
                        '<div>' +
                            '<div class="font-semibold">' + data.teacher.name + '</div>' +
                            '<div class="text-xs text-gray-500">' + data.teacher.unit + '</div>' +
                        '</div>' +
                    '</div>';

                document.getElementById("replaceModal").classList.remove("hidden");
                document.getElementById("replaceModal").classList.add("flex");

            } else {
                form.submit();
            }

        })
        .catch(() => {
            form.submit();
        });

    });

    window.confirmReplace = function(){
        forceReplace.value = 1;
        document.getElementById("replaceModal").classList.add("hidden");
        form.submit();
    };

    window.closeModal = function(){
        document.getElementById("replaceModal").classList.add("hidden");
    };

});
</script>

</x-layouts.admin>