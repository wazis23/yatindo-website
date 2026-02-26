<x-layouts.admin>

<x-slot name="header">
    <div class="flex items-center justify-between w-full">

        <h2 class="text-2xl font-bold text-gray-800">
            Edit Berita
        </h2>

        <a href="{{ route('admin.posts.index') }}"
           id="btnBack"
           class="inline-flex items-center gap-2 px-5 py-2.5
                  bg-gradient-to-r from-red-600 to-red-700
                  hover:from-red-700 hover:to-red-800
                  text-white font-semibold rounded-xl
                  shadow-md transition">

            ← Kembali
        </a>
    </div>
</x-slot>

<div class="p-6">
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8">

<form method="POST"
      action="{{ route('admin.posts.update',$post->id) }}"
      enctype="multipart/form-data"
      class="space-y-6">

@csrf
@method('PUT')

<input type="hidden" id="post_id" value="{{ $post->id }}">

<!-- Judul -->
<div>
<label class="block text-sm font-semibold mb-2">
    Judul Berita
</label>

<input type="text"
       name="title"
       id="titleInput"
       value="{{ old('title',$post->title) }}"
       class="w-full px-4 py-3 rounded-xl border border-gray-300">
</div>

<!-- Konten -->
<div>
<label class="block text-sm font-semibold mb-2">
    Konten
</label>

<textarea id="editor"
          name="content"
          class="w-full border rounded-xl">
    {{ old('content',$post->content) }}
</textarea>
</div>

<!-- Gambar Utama -->
<div>
<label class="block text-sm font-semibold mb-2">
    Gambar Utama
</label>

<div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">

<input type="file"
       name="featured_image"
       id="featured_image"
       class="hidden"
       accept="image/*">

<label for="featured_image"
       class="cursor-pointer text-blue-600 font-medium">
    Klik untuk upload gambar
</label>

@if($post->featured_image)
<div class="mt-4">
    <img src="{{ asset('storage/'.$post->featured_image) }}"
         class="rounded-xl max-h-60 mx-auto shadow-md">
</div>
@endif

<div id="previewContainer"
     class="mt-4 hidden relative inline-block">

<img id="imagePreview"
     class="rounded-xl shadow-md max-h-60 object-cover">

<button type="button"
        id="removeImage"
        class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-8 h-8">
✕
</button>

</div>
</div>
</div>

<div class="flex justify-between items-center">

<p id="autosaveStatus"
   class="text-sm text-gray-500 flex items-center gap-2">
   <span id="autosaveSpinner" class="hidden animate-spin h-4 w-4 border-2 border-blue-500 border-t-transparent rounded-full"></span>
   <span id="autosaveText">Tidak ada perubahan</span>
</p>

<button type="submit"
        class="bg-blue-600 text-white px-6 py-3 rounded-xl shadow-md">
Update Berita
</button>

</div>
<input type="hidden" id="post_id" value="{{ $post->id ?? '' }}">
</form>
</div>
</div>

{{-- CKEditor Super Build --}}
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
            .then(async response => {
                if (!response.ok) {
                    throw new Error('HTTP error');
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

});
</script>

@endpush
</x-layouts.admin>