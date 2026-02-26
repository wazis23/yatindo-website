<x-layouts.admin>
   <x-slot name="header">
    <div class="flex items-center justify-between w-full">

        <h2 class="text-2xl font-bold text-gray-800">
            Tambah Berita
        </h2>

        <a href="{{ route('admin.posts.index') }}"
            id="btnBack"
            class="inline-flex items-center gap-2 px-5 py-2.5
                  bg-gradient-to-r from-red-600 to-red-700
                  hover:from-red-700 hover:to-red-800
                  text-white font-semibold rounded-xl
                  shadow-md hover:shadow-lg
                  transition duration-200">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-4 w-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>

            Kembali
        </a>

    </div>
</x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8">

            <form method="POST"
                  action="{{ route('admin.posts.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Judul Berita
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Masukkan judul berita..."
                           class="w-full px-4 py-3 rounded-xl border transition 
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none
                                  @error('title') border-red-500 @else border-gray-300 @enderror">

                    @error('title')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Konten -->
                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Konten
                    </label>

                    <textarea id="editor"
                            name="content"
                            rows="6"
                            class="w-full px-4 py-3 rounded-xl border
                                    focus:ring-2 focus:ring-blue-500 focus:outline-none
                                    @error('content') border-red-500 @else border-gray-300 @enderror">
                        {{ old('content') }}
                    </textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Upload Gambar Modern -->
                <div>
                    <label class="block text-sm font-semibold mb-2">
                        Gambar Utama
                    </label>

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition">
                        <input type="file"
                               name="featured_image"
                               id="featured_image"
                               class="hidden"
                               accept="image/*">

                        <label for="featured_image"
                               class="cursor-pointer text-blue-600 font-medium">
                            Klik untuk upload gambar
                        </label>

                        <p class="text-xs text-gray-500 mt-2">
                            JPG, PNG, WEBP (Max 2MB)
                        </p>

                        <!-- Preview -->
                        <div id="previewContainer" class="mt-4 hidden relative inline-block">
                            
                            <img id="imagePreview"
                                class="rounded-xl shadow-md max-h-60 object-cover">

                            <!-- Tombol X -->
                            <button type="button"
                                    id="removeImage"
                                    class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 
                                        text-white rounded-full w-8 h-8 flex items-center 
                                        justify-center shadow-lg transition">
                                ✕
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-md transition duration-200">
                        Simpan Berita
                    </button>
                </div>
                <p class="text-sm flex items-center gap-2 mt-2">

    <!-- Spinner -->
    <span id="autosaveSpinner"
          class="hidden animate-spin h-4 w-4 border-2 border-blue-500 border-t-transparent rounded-full">
    </span>

    <!-- Check Icon -->
    <svg id="autosaveCheck"
         xmlns="http://www.w3.org/2000/svg"
         class="hidden h-4 w-4 text-green-600"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5 13l4 4L19 7" />
    </svg>

    <span id="autosaveText" class="text-gray-500">
        Semua perubahan tersimpan
    </span>

</p>
            <input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
            </form>
        </div>
    </div>

    <!-- Preview Script -->
   @push('scripts')
        <script>
        document.addEventListener("DOMContentLoaded", function () {

            const inputFile = document.getElementById('featured_image');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('imagePreview');
            const removeBtn = document.getElementById('removeImage');

            if (!inputFile) return;

            inputFile.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });

            removeBtn.addEventListener('click', function() {
                inputFile.value = '';
                previewImage.src = '';
                previewContainer.classList.add('hidden');
            });

        });
        </script>
        @endpush

@push('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let editorInstance;
    let autosaveTimer;
    let postId = document.getElementById('post_id').value || '';
    let lastContent = '';

    const titleInput = document.querySelector('input[name="title"]');

    // INIT CKEDITOR
    CKEDITOR.ClassicEditor.create(document.querySelector('#editor'), {

        licenseKey: 'GPL',

        removePlugins: [
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'AIAssistant',
            'FormatPainter',
            'SlashCommand',
            'Template',
            'CaseChange',
            'PasteFromOfficeEnhanced',
            'MultiLevelList',
            'TableOfContents',
            'DocumentOutline'
        ],

        toolbar: {
            items: [
                'heading','|',
                'bold','italic','underline','|',
                'alignment','|',
                'bulletedList','numberedList','|',
                'link','blockQuote','|',
                'insertTable','uploadImage','mediaEmbed','|',
                'undo','redo'
            ]
        },

        simpleUpload: {
            uploadUrl: "{{ route('admin.upload.image') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        }

    }).then(editor => {

        editorInstance = editor;

        editor.model.document.on('change:data', triggerAutosave);

    }).catch(error => console.error(error));


    titleInput.addEventListener('input', triggerAutosave);


    function triggerAutosave(){

        clearTimeout(autosaveTimer);

        autosaveTimer = setTimeout(()=>{

            if(!editorInstance) return;

            const currentContent = editorInstance.getData();

            if(currentContent === lastContent){
                return;
            }

            // SHOW SPINNER
            document.getElementById('autosaveSpinner').classList.remove('hidden');
            document.getElementById('autosaveCheck').classList.add('hidden');
            document.getElementById('autosaveText').innerText = "Menyimpan draft...";

            fetch("{{ route('admin.posts.autosave') }}",{
                method:"POST",
                headers:{
                    "X-CSRF-TOKEN":"{{ csrf_token() }}",
                    "Content-Type":"application/json"
                },
                body:JSON.stringify({
                    post_id:postId,
                    title:titleInput.value,
                    content:currentContent
                })
            })
            .then(response => {
                if(!response.ok){
                    throw new Error("Server error");
                }
                return response.json();
            })
            .then(data => {

                if(data.success){

                    postId = data.post_id;
                    document.getElementById('post_id').value = postId;
                    lastContent = currentContent;

                    document.getElementById('autosaveSpinner').classList.add('hidden');
                    document.getElementById('autosaveCheck').classList.remove('hidden');
                    document.getElementById('autosaveText').innerText = "Draft tersimpan";

                    setTimeout(()=>{
                        document.getElementById('autosaveText').innerText = "Semua perubahan tersimpan";
                    },3000);
                }

            })
            .catch(error => {
                console.error(error);
                document.getElementById('autosaveSpinner').classList.add('hidden');
                document.getElementById('autosaveText').innerText = "Gagal menyimpan";
            });

        },10000);
    }
    document.getElementById('btnBack')?.addEventListener('click', function(e){

    if(!postId) return;

    e.preventDefault(); // tahan redirect dulu

    fetch(`/admin/posts/${postId}`, {
        method:"DELETE",
        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}",
            "Accept":"application/json"
        }
    })
    .then(()=> {
        window.location.href = "{{ route('admin.posts.index') }}";
    })
    .catch(()=> {
        window.location.href = "{{ route('admin.posts.index') }}";
    });

});

});
</script>

@endpush


</x-layouts.admin>