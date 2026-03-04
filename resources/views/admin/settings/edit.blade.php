<x-layouts.admin>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Pengaturan Website
        </h2>
    </x-slot>

    <form method="POST"
          action="{{ route('admin.settings.update') }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="max-w-5xl space-y-6">

            <!-- INFORMASI WEBSITE -->
            <div class="bg-white rounded-xl shadow-sm border p-6">

                <h3 class="font-semibold text-gray-700 mb-4">
                    Informasi Website
                </h3>

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-gray-500">
                            Nama Portal
                        </label>

                        <input type="text"
                               name="site_name"
                               value="{{ settings('site_name') }}"
                               class="mt-1 w-full border rounded-lg p-2">
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">
                            Nama Yayasan / Sekolah
                        </label>

                        <input type="text"
                               name="school_name"
                               value="{{ settings('school_name') }}"
                               class="mt-1 w-full border rounded-lg p-2">
                    </div>

                </div>

            </div>


            <!-- LOGO ADMIN & FAVICON -->
            <div class="bg-white rounded-xl shadow-sm border p-6">

                <h3 class="font-semibold text-gray-700 mb-6">
                    Logo Website
                </h3>

                <div class="grid grid-cols-2 gap-8">

                    <!-- LOGO ADMIN -->
                    <div>

                        <label class="text-sm text-gray-500 block mb-2">
                            Logo Admin Panel
                        </label>

                        <div class="flex items-center gap-4">

                            <div class="relative">

                                <img id="iconPreview"
                                     src="{{ settings('logo_admin') ? asset('storage/'.settings('logo_admin')) : asset('logo.png') }}"
                                     class="h-16 object-contain border rounded-lg bg-gray-50 p-2">

                                <button type="button"
                                        onclick="removeIcon()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full text-xs">
                                    ✕
                                </button>

                            </div>

                            <input type="file"
                                   name="logo_admin"
                                   id="iconInput"
                                   class="text-sm">

                        </div>

                    </div>


                    <!-- FAVICON -->
                    <div>

                        <label class="text-sm text-gray-500 block mb-2">
                            Favicon
                        </label>

                        <div class="flex items-center gap-4">

                            <div class="relative">

                                <img id="faviconPreview"
                                     src="{{ settings('favicon') ? asset('storage/'.settings('favicon')) : asset('favicon.ico') }}"
                                     class="w-16 h-16 object-contain border rounded-lg bg-gray-50 p-2">

                                <button type="button"
                                        onclick="removeFavicon()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full text-xs">
                                    ✕
                                </button>

                            </div>

                            <input type="file"
                                   name="favicon"
                                   id="faviconInput"
                                   class="text-sm">

                        </div>

                    </div>

                </div>

            </div>


            <!-- KONTAK -->
            <div class="bg-white rounded-xl shadow-sm border p-6">

                <h3 class="font-semibold text-gray-700 mb-4">
                    Kontak
                </h3>

                <div class="space-y-4">

                    <input type="email"
                           name="email"
                           value="{{ settings('email') }}"
                           placeholder="Email"
                           class="w-full border rounded-lg p-2">

                    <input type="text"
                           name="phone"
                           value="{{ settings('phone') }}"
                           placeholder="Nomor Telepon"
                           class="w-full border rounded-lg p-2">

                    <textarea name="address"
                              placeholder="Alamat"
                              class="w-full border rounded-lg p-2">{{ settings('address') }}</textarea>

                    <textarea name="maps_embed"
                              placeholder="Embed Google Maps"
                              class="w-full border rounded-lg p-2">{{ settings('maps_embed') }}</textarea>

                </div>

            </div>


            <!-- SOCIAL MEDIA -->
            <div class="bg-white rounded-xl shadow-sm border p-6">

                <h3 class="font-semibold text-gray-700 mb-4">
                    Social Media
                </h3>

                <div class="grid grid-cols-2 gap-4">

                    <input type="text"
                           name="facebook"
                           value="{{ settings('facebook') }}"
                           placeholder="Facebook URL"
                           class="border rounded-lg p-2">

                    <input type="text"
                           name="instagram"
                           value="{{ settings('instagram') }}"
                           placeholder="Instagram URL"
                           class="border rounded-lg p-2">

                    <input type="text"
                           name="youtube"
                           value="{{ settings('youtube') }}"
                           placeholder="YouTube URL"
                           class="border rounded-lg p-2">

                    <input type="text"
                           name="tiktok"
                           value="{{ settings('tiktok') }}"
                           placeholder="TikTok URL"
                           class="border rounded-lg p-2">

                    <input type="text"
                           name="whatsapp"
                           value="{{ settings('whatsapp') }}"
                           placeholder="WhatsApp Number"
                           class="border rounded-lg p-2">

                </div>

            </div>


            <!-- MAINTENANCE -->
            <div class="bg-white rounded-xl shadow-sm border p-6">

                <label class="flex items-center gap-3">

                    <input type="checkbox"
                           name="maintenance_mode"
                           value="1"
                           {{ settings('maintenance_mode') ? 'checked' : '' }}>

                    Aktifkan Maintenance Mode

                </label>

            </div>


            <!-- BUTTON SAVE -->
            <div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                    Simpan Pengaturan
                </button>

            </div>

        </div>

    </form>



@push('scripts')

<script>

const iconInput = document.getElementById('iconInput');
const iconPreview = document.getElementById('iconPreview');

const faviconInput = document.getElementById('faviconInput');
const faviconPreview = document.getElementById('faviconPreview');


iconInput.addEventListener('change', function(){

    const file = this.files[0];

    if(file){
        iconPreview.src = URL.createObjectURL(file);
    }

});


faviconInput.addEventListener('change', function(){

    const file = this.files[0];

    if(file){
        faviconPreview.src = URL.createObjectURL(file);
    }

});


function removeIcon(){

    iconPreview.src = "{{ asset('logo.png') }}";
    iconInput.value = "";

}


function removeFavicon(){

    faviconPreview.src = "{{ asset('favicon.ico') }}";
    faviconInput.value = "";

}

</script>

@endpush


</x-layouts.admin>