<x-layouts.admin>

<h1 class="text-2xl font-bold mb-6">Pengaturan Website</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form method="POST"
      action="{{ route('admin.settings.update') }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-4xl">

@csrf
@method('PUT')

<h2 class="font-semibold mb-4">Informasi Dasar</h2>

<input type="text" name="site_name"
value="{{ old('site_name',$setting->site_name) }}"
placeholder="Site Name"
class="w-full border p-2 rounded mb-3">

<input type="text" name="school_name"
value="{{ old('school_name',$setting->school_name) }}"
placeholder="Nama Sekolah"
class="w-full border p-2 rounded mb-3">

<hr class="my-6">

<h2 class="font-semibold mb-4">Logo</h2>

@if($setting->logo_frontend)
<img src="{{ asset('storage/'.$setting->logo_frontend) }}"
class="h-16 mb-2">
@endif
<input type="file" name="logo_frontend" class="mb-4">

@if($setting->logo_admin)
<img src="{{ asset('storage/'.$setting->logo_admin) }}"
class="h-16 mb-2">
@endif
<input type="file" name="logo_admin" class="mb-4">

@if($setting->favicon)
<img src="{{ asset('storage/'.$setting->favicon) }}"
class="h-10 mb-2">
@endif
<input type="file" name="favicon" class="mb-4">

<hr class="my-6">

<h2 class="font-semibold mb-4">Kontak</h2>

<input type="email" name="email"
value="{{ old('email',$setting->email) }}"
placeholder="Email"
class="w-full border p-2 rounded mb-3">

<input type="text" name="phone"
value="{{ old('phone',$setting->phone) }}"
placeholder="Phone"
class="w-full border p-2 rounded mb-3">

<textarea name="address"
class="w-full border p-2 rounded mb-3"
rows="3">{{ old('address',$setting->address) }}</textarea>

<textarea name="maps_embed"
class="w-full border p-2 rounded mb-3"
rows="3">{{ old('maps_embed',$setting->maps_embed) }}</textarea>

<hr class="my-6">

<h2 class="font-semibold mb-4">Social Media</h2>

<input type="url" name="facebook"
value="{{ old('facebook',$setting->facebook) }}"
placeholder="Facebook URL"
class="w-full border p-2 rounded mb-3">

<input type="url" name="instagram"
value="{{ old('instagram',$setting->instagram) }}"
placeholder="Instagram URL"
class="w-full border p-2 rounded mb-3">

<input type="url" name="youtube"
value="{{ old('youtube',$setting->youtube) }}"
placeholder="YouTube URL"
class="w-full border p-2 rounded mb-3">

<input type="url" name="tiktok"
value="{{ old('tiktok',$setting->tiktok) }}"
placeholder="TikTok URL"
class="w-full border p-2 rounded mb-3">

<input type="text" name="whatsapp"
value="{{ old('whatsapp',$setting->whatsapp) }}"
placeholder="WhatsApp Number"
class="w-full border p-2 rounded mb-3">

<hr class="my-6">

<div class="flex items-center mb-4">
<input type="checkbox" name="maintenance_mode"
{{ $setting->maintenance_mode ? 'checked' : '' }}>
<span class="ml-2">Aktifkan Maintenance Mode</span>
</div>

<button class="bg-blue-600 text-white px-6 py-2 rounded">
Simpan Pengaturan
</button>

</form>

</x-layouts.admin>