<x-layouts.admin>
<x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Slider</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST"
              action="{{ route('admin.sliders.store') }}"
              enctype="multipart/form-data">

            @csrf

            <!-- Upload gambar slider -->
            <div>
                <label>Gambar Slider</label>
                <input type="file" name="image" class="border w-full p-2" required>
            </div>

            <!-- Urutan tampil slider -->
            <div class="mt-3">
                <label>Urutan Tampil</label>
                <input type="number" name="order_no"
                       class="border w-full p-2" value="1">
            </div>

            <!-- Tombol simpan -->
            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-layouts.admin>
