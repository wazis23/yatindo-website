<x-layouts.admin>

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Album: {{ $album->title }}
    </h1>
    <p class="text-sm text-gray-500">
        {{ $album->description }}
    </p>
    <div class="border-b mt-4"></div>
</div>


{{-- PANEL UPLOAD FOTO --}}
<div class="bg-white rounded-2xl shadow p-6 mb-8">

    <h3 class="text-lg font-semibold mb-4">
        Upload Foto ke Album
    </h3>

    <form action="{{ route('admin.albums.upload', $album->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- DROP AREA --}}
        <div id="dropArea"
             class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-blue-500 transition">

            <p class="text-gray-500">
                Seret & lepaskan foto di sini<br>
                atau <span class="text-blue-600 font-semibold">klik untuk memilih</span>
            </p>

            <input type="file"
                   id="photoInput"
                   name="photos[]"
                   multiple
                   class="hidden">
        </div>

        {{-- PREVIEW --}}
        <div id="previewContainer" class="grid grid-cols-3 md:grid-cols-6 gap-4 mt-6"></div>
        
		{{-- PROGRESS BAR --}}
		<div id="progressWrapper" class="mt-6 hidden">
			<div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
			<div id="progressBar"
				class="bg-blue-600 h-4 w-0 text-xs text-white text-center transition-all duration-300">
			</div>
		</div>
			<p id="progressText" class="text-sm text-gray-600 mt-2 text-center">
				Mengupload...
			</p>
		</div>

        <button type="button"
				id="uploadBtn"
				class="mt-6 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
			Upload Foto
		</button>
    </form>
</div>



{{-- GRID FOTO --}}
<div class="bg-white rounded-2xl shadow p-6">

    <h3 class="text-lg font-semibold mb-4">
        Daftar Foto Dalam Album
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @forelse($album->photos as $photo)
        <div class="relative group">
            
			{{-- gambar --}}
            <div class="bg-white rounded-xl shadow p-3">

			<img src="{{ asset('storage/'.$photo->image) }}"
				class="w-full h-40 object-contain mb-3">

			<div class="flex items-center gap-2">
	
				<input type="text"
					value="{{ $photo->title }}"
					data-id="{{ $photo->id }}"
					class="photo-title border rounded px-2 py-1 text-sm w-full focus:ring focus:ring-blue-200">

				<button type="button"
						class="save-btn bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700"
						data-id="{{ $photo->id }}">
					💾
				</button>

			</div>

			<p class="save-status text-xs text-green-600 mt-1 hidden">
				✔ Tersimpan
			</p>

		</div>


            {{-- Tombol hapus --}}
            <form action="{{ route('admin.galleries.destroy', $photo->id) }}"
                  method="POST"
                  class="absolute top-2 right-2 hidden group-hover:block">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white text-xs px-2 py-1 rounded">
                    Hapus
                </button>
            </form>
            {{-- TOMBOL COVER ALBUM --}}
			<div class="absolute top-2 left-2">
				<form action="{{ route('admin.albums.setCover', $photo->id) }}" method="POST">
					@csrf
					<button
						class="text-xs px-2 py-1 rounded
						{{ $album->cover_photo_id == $photo->id
							? 'bg-green-600 text-white'
							: 'bg-black/60 text-white hover:bg-blue-600' }}">
						{{ $album->cover_photo_id == $photo->id ? 'Cover' : 'Jadikan Cover' }}
					</button>
				</form>
			</div>
		</div>
        @empty
            <p class="text-gray-400 col-span-4">
                Belum ada foto di album ini.
            </p>
        @endforelse

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
const dropArea = document.getElementById('dropArea');
const input = document.getElementById('photoInput');
const previewContainer = document.getElementById('previewContainer');

let fileStore = [];
function compressImage(file, callback) {

    const img = new Image();
    const reader = new FileReader();

    reader.onload = e => {
        img.src = e.target.result;
    };

    img.onload = () => {

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        const MAX_WIDTH = 1600;
        const scale = MAX_WIDTH / img.width;

        canvas.width = MAX_WIDTH;
        canvas.height = img.height * scale;

        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        canvas.toBlob(blob => {
            const compressedFile = new File([blob], file.name, {
                type: 'image/jpeg',
                lastModified: Date.now()
            });
            callback(compressedFile);
        }, 'image/jpeg', 0.7); // 0.7 = kualitas 70%
    };

    reader.readAsDataURL(file);
}
// Klik area = buka file dialog
dropArea.addEventListener('click', () => input.click());

// Drag style
['dragenter','dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
        e.preventDefault();
        dropArea.classList.add('border-blue-500','bg-blue-50');
    });
});

['dragleave','drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
        e.preventDefault();
        dropArea.classList.remove('border-blue-500','bg-blue-50');
    });
});

// Drop file
dropArea.addEventListener('drop', e => {
    const files = Array.from(e.dataTransfer.files);
    addFiles(files);
});

// Input biasa
input.addEventListener('change', e => {
    addFiles(Array.from(e.target.files));
});
previewContainer.innerHTML = '<p class="col-span-full text-gray-400">Memproses gambar...</p>';
function addFiles(files) {
    files.forEach(file => {
        if(file.type.startsWith('image/')) {
            compressImage(file, function(compressed) {
                // Masukkan hasil compress
                fileStore.push(compressed);
                // Baru render setelah file masuk
                renderPreview();
                syncInputFiles();
            });
        }
    });
}

function renderPreview() {
    previewContainer.innerHTML = '';

    fileStore.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = e => {
            const box = document.createElement('div');
			box.className = "relative group";
			box.setAttribute('data-name', file.name);
            box.innerHTML = `
                <img src="${e.target.result}"
                     class="w-full h-32 object-cover rounded shadow">

                <button type="button"
                        class="absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                        ✕
                </button>
            `;

            box.querySelector('button').addEventListener('click', () => {
                fileStore.splice(index, 1);
                renderPreview();
                syncInputFiles();
            });

            previewContainer.appendChild(box);
        };

        reader.readAsDataURL(file);
    });
}
new Sortable(previewContainer, {
    animation: 150,
    ghostClass: 'opacity-40',

    onEnd: function () {
        updateFileOrder();
    }
});
function syncInputFiles() {
    const dataTransfer = new DataTransfer();
    fileStore.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}
function updateFileOrder() {

    const newOrder = [];

    const boxes = previewContainer.querySelectorAll('div.relative');

    boxes.forEach(box => {
        const name = box.getAttribute('data-name');
        const file = fileStore.find(f => f.name === name);
        if(file) newOrder.push(file);
    });

    fileStore = newOrder;
    syncInputFiles();
}
</script>

<script>
const uploadBtn = document.getElementById('uploadBtn');
const progressWrapper = document.getElementById('progressWrapper');
const progressBar = document.getElementById('progressBar');
const progressText = document.getElementById('progressText');

uploadBtn.addEventListener('click', function () {

    if(fileStore.length === 0) {
        alert('Pilih foto dulu');
        return;
    }

    const formData = new FormData();
    fileStore.forEach(file => formData.append('photos[]', file));

    formData.append('_token', '{{ csrf_token() }}');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', "{{ route('admin.albums.upload', $album->id) }}", true);

    // Tampilkan progress
    progressWrapper.classList.remove('hidden');

    xhr.upload.onprogress = function (e) {
        if(e.lengthComputable) {
            let percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressBar.innerText = percent + '%';
            progressText.innerText = 'Upload ' + percent + '%';
        }
    };

    xhr.onload = function () {
        if(xhr.status === 200) {
            progressBar.style.width = '100%';
            progressText.innerText = 'Upload Selesai 🎉';

            setTimeout(() => {
                location.reload(); // refresh biar foto muncul
            }, 800);
        } else {
            alert('Upload gagal');
        }
    };

    xhr.send(formData);
});
</script>


{{-- MODAL PREVIEW --}}
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

    <span id="closeModal"
          class="absolute top-6 right-8 text-white text-3xl cursor-pointer">&times;</span>

    <img id="modalImage"
         class="max-h-[90%] max-w-[90%] rounded shadow-lg">
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const closeBtn = document.getElementById('closeModal');

    document.querySelectorAll('.preview-img').forEach(img => {
        img.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = this.dataset.src;
        });
    });

    closeBtn.onclick = () => modal.classList.add('hidden');
    modal.onclick = () => modal.classList.add('hidden');

});
</script>

<script>
document.querySelectorAll('.photo-title').forEach(input => {

    input.addEventListener('change', function () {

        fetch("{{ route('admin.galleries.updateTitle', '') }}/" + this.dataset.id + "/update-title", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                title: this.value
            })
        });

    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function saveTitle(photoId, newTitle, card) {

        const status = card.querySelector('.save-status');

        fetch("{{ url('/admin/gallery') }}/" + photoId + "/update-title", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ title: newTitle })
        })
        .then(res => res.json())
        .then(() => {
            status.classList.remove('hidden');
            setTimeout(() => status.classList.add('hidden'), 1500);
        });
    }

    // ENTER KEY
    document.querySelectorAll('.photo-title').forEach(input => {
        input.addEventListener('keypress', function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                const card = this.closest('.bg-white'); // ambil card foto
                saveTitle(this.dataset.id, this.value, card);
            }
        });
    });

    // BUTTON SAVE
    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.bg-white'); // ambil card foto
            const input = card.querySelector('.photo-title');
            saveTitle(this.dataset.id, input.value, card);
        });
    });

});
</script>


</x-layouts.admin>
