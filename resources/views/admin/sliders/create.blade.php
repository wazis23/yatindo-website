<x-layouts.admin>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Slider
        </h1>

        <p class="text-sm text-gray-500">
            Upload beberapa gambar slider sekaligus
        </p>
    </div>


    <div class="bg-white shadow rounded-lg p-6">

        <form
            id="sliderForm"
            method="POST"
            action="{{ route('admin.sliders.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <input
                type="hidden"
                name="type"
                value="{{ $type }}"
            >


            {{-- Upload Area --}}
            <div
                id="dropZone"
                class="border-2 border-dashed border-gray-300 rounded-lg p-10 text-center cursor-pointer hover:bg-gray-50 transition"
            >
                <p class="text-gray-600 font-semibold">
                    Drag & Drop gambar disini
                </p>

                <p class="text-sm text-gray-400">
                    atau klik untuk memilih gambar
                </p>

                <input
                    type="file"
                    name="images[]"
                    id="imageInput"
                    multiple
                    class="hidden"
                >
            </div>


            {{-- Preview --}}
            <div
                id="previewContainer"
                class="grid grid-cols-4 gap-4 mt-6"
            ></div>


            {{-- Progress --}}
            <div
                id="uploadProgress"
                class="w-full bg-gray-200 rounded h-3 mt-6 hidden"
            >
                <div
                    id="uploadBar"
                    class="bg-green-600 h-3 rounded"
                    style="width:0%"
                ></div>
            </div>


            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow"
                >
                    Simpan Slider
                </button>
            </div>

        </form>

    </div>

</x-layouts.admin>


{{-- CropperJS --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>


{{-- SortableJS --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const dropZone        = document.getElementById('dropZone');
    const input           = document.getElementById('imageInput');
    const preview         = document.getElementById('previewContainer');

    const progress        = document.getElementById('uploadProgress');
    const progressBar     = document.getElementById('uploadBar');
    const form            = document.getElementById('sliderForm');

    let files = [];



    /* ===============================
       Click Upload
    =============================== */

    dropZone.addEventListener('click', function () {
        input.click();
    });



    /* ===============================
       Input Upload
    =============================== */

    input.addEventListener('change', function (e) {
        handleFiles(e.target.files);
    });



    /* ===============================
       Drag Over
    =============================== */

    dropZone.addEventListener('dragover', function (e) {

        e.preventDefault();

        dropZone.classList.add('bg-gray-100');

    });



    /* ===============================
       Drag Leave
    =============================== */

    dropZone.addEventListener('dragleave', function () {

        dropZone.classList.remove('bg-gray-100');

    });



    /* ===============================
       Drop File
    =============================== */

    dropZone.addEventListener('drop', function (e) {

        e.preventDefault();

        dropZone.classList.remove('bg-gray-100');

        handleFiles(e.dataTransfer.files);

    });



    /* ===============================
       Handle Files
    =============================== */

    function handleFiles(selectedFiles) {

        [...selectedFiles].forEach(file => {

            if (!file.type.startsWith('image/')) {
                return;
            }

            compressImage(file, function (compressedFile) {

                files.push(compressedFile);

                previewImage(compressedFile);

                updateInputFiles();

            });

        });

    }



    /* ===============================
       Update input file
    =============================== */

    function updateInputFiles(){

        const dt = new DataTransfer();

        files.forEach(file => {

            dt.items.add(file);

        });

        input.files = dt.files;

    }



    /* ===============================
       Compress Image
    =============================== */

    function compressImage(file, callback) {

        const reader = new FileReader();

        reader.onload = function (e) {

            const img = new Image();

            img.onload = function () {

                const canvas = document.createElement('canvas');
                const ctx    = canvas.getContext('2d');

                const maxWidth = 1920;
                const scale    = maxWidth / img.width;

                canvas.width  = maxWidth;
                canvas.height = img.height * scale;

                ctx.drawImage(
                    img,
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );

                canvas.toBlob(function (blob) {

                    const newFile = new File(
                        [blob],
                        file.name,
                        { type: 'image/jpeg' }
                    );

                    callback(newFile);

                }, 'image/jpeg', 0.85);

            };

            img.src = e.target.result;

        };

        reader.readAsDataURL(file);

    }



    /* ===============================
       Preview Image
    =============================== */

    function previewImage(file) {

        const reader = new FileReader();

        reader.onload = function (e) {

            const index = files.length - 1;

            const wrapper = document.createElement('div');

            wrapper.dataset.index = index;

            wrapper.className =
                "relative border rounded overflow-hidden group";

            wrapper.innerHTML = `
                <img
                    src="${e.target.result}"
                    class="w-full h-32 object-cover"
                >

                <button
                    type="button"
                    class="remove-btn absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded"
                >
                    ✕
                </button>

                <button
                    type="button"
                    class="crop-btn absolute bottom-1 right-1 bg-blue-600 text-white text-xs px-2 py-1 rounded"
                >
                    Crop
                </button>
            `;

            preview.appendChild(wrapper);



            /* Remove */

            wrapper
                .querySelector('.remove-btn')
                .addEventListener('click', function () {

                    const index = [...preview.children].indexOf(wrapper);

                    files.splice(index,1);

                    wrapper.remove();

                    updateInputFiles();

                });



            /* Crop */

            wrapper
                .querySelector('.crop-btn')
                .addEventListener('click', function () {

                    openCropper(e.target.result, wrapper);

                });

        };

        reader.readAsDataURL(file);

    }



    /* ===============================
       Cropper
    =============================== */

    function openCropper(src, wrapper) {

        const modal = document.createElement('div');

        modal.className =
            "fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 overflow-y-auto";

        modal.innerHTML = `
            <div class="bg-white p-4 rounded shadow w-full max-w-3xl my-10">

                <div class="max-h-[70vh] overflow-auto">
                    <img
                        id="cropImage"
                        src="${src}"
                        class="max-w-full"
                    >
                </div>

                <div class="mt-4 flex justify-end gap-2">

                    <button
                        id="cropCancel"
                        class="px-4 py-2 bg-gray-300 rounded"
                    >
                        Batal
                    </button>

                    <button
                        id="cropSave"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        Simpan
                    </button>

                </div>

            </div>
        `;

        document.body.appendChild(modal);

        const image = modal.querySelector('#cropImage');

        const cropper = new Cropper(image, {
            aspectRatio: 16 / 9,
            viewMode: 1
        });

        modal.querySelector('#cropCancel').onclick = function () {

            modal.remove();
            cropper.destroy();

        };

        modal.querySelector('#cropSave').onclick = function () {

            const canvas = cropper.getCroppedCanvas();

            wrapper.querySelector('img').src =
                canvas.toDataURL();

            modal.remove();
            cropper.destroy();

        };

    }



    /* ===============================
       Sortable Preview
    =============================== */

    new Sortable(preview, {

        animation:150,

        onEnd:function(){

            const newFiles = [];

            [...preview.children].forEach((el,index)=>{

                newFiles.push(files[index]);

            });

            files = newFiles;

            updateInputFiles();

        }

    });



    /* ===============================
       Upload Progress UI
    =============================== */

    form.addEventListener('submit', function () {

        progress.classList.remove('hidden');

        let width = 0;

        const interval = setInterval(function () {

            width += 10;

            progressBar.style.width = width + '%';

            if (width >= 100) {
                clearInterval(interval);
            }

        }, 200);

    });

});

</script>