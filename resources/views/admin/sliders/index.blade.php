<x-layouts.admin>

    {{-- Header --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Manajemen Slider Hero
            </h1>

            <p class="text-sm text-gray-500 mb-4">
                Kelola slider hero untuk setiap halaman
            </p>

            <a
                href="{{ route('admin.sliders.create',['type'=>$type]) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                + Tambah Slider
            </a>

        </div>


        {{-- Mini Preview --}}
        <div class="relative h-40 rounded overflow-hidden shadow">

            @foreach ($sliders as $index => $slider)

                <img
                    src="{{ asset('storage/'.$slider->image) }}"
                    class="slider-preview absolute inset-0 w-full h-full object-cover transition-opacity duration-1000
                    {{ $index == 0 ? 'opacity-100' : 'opacity-0' }}"
                >

            @endforeach

            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">

                <span class="text-white text-sm font-semibold">
                    Preview Hero Slider
                </span>

            </div>

        </div>

    </div>



    {{-- Filter + Edit Button --}}
    <div class="mb-6 flex items-center gap-4">

        <form method="GET">

            <select
                name="type"
                onchange="this.form.submit()"
                class="border rounded p-2"
            >

                @foreach ($types as $t)

                    <option
                        value="{{ $t }}"
                        {{ $type == $t ? 'selected' : '' }}
                    >
                        {{ strtoupper($t) }}
                    </option>

                @endforeach

            </select>

        </form>


        <button
            id="editOrderBtn"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow"
        >
            Edit
        </button>

    </div>



    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700">

                <tr>

                    <th class="p-4 w-40">
                        Preview
                    </th>

                    <th class="p-4 w-32">
                        Urutan
                    </th>

                    <th class="p-4 w-40">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($sliders as $slider)

                    <tr class="border-t">

                        {{-- Preview --}}
                        <td class="p-4">

                            <img
                                src="{{ asset('storage/'.$slider->image) }}"
                                class="w-36 h-20 object-cover rounded shadow"
                            >

                        </td>


                        {{-- Order --}}
                        <td class="p-4">

                            <input
                                type="number"
                                value="{{ $slider->order_no }}"
                                disabled
                                class="order-input border rounded p-1 w-20 bg-gray-100"
                                data-id="{{ $slider->id }}"
                            >

                        </td>


                        {{-- Delete --}}
                        <td class="p-4">

                            <form
                                method="POST"
                                action="{{ route('admin.sliders.destroy',$slider->id) }}"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="3"
                            class="text-center p-6 text-gray-500"
                        >
                            Belum ada slider
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</x-layouts.admin>



<script>

let editMode = false;

const editBtn = document.getElementById('editOrderBtn');
const inputs  = document.querySelectorAll('.order-input');

editBtn.addEventListener('click', function(){

    if(!editMode){

        inputs.forEach(function(input){

            input.disabled = false;
            input.classList.remove('bg-gray-100');

        });

        editBtn.innerText = "Simpan";

        editMode = true;

    }else{

        let orders = {};

        inputs.forEach(function(input){

            orders[input.dataset.id] = input.value;

        });

        fetch("{{ route('admin.sliders.updateOrder') }}",{

            method:"POST",

            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":
                document.querySelector('meta[name="csrf-token"]').content
            },

            body:JSON.stringify({
                orders:orders
            })

        })
        .then(res => res.json())
        .then(data => {

            inputs.forEach(function(input){

                input.disabled = true;
                input.classList.add('bg-gray-100');

            });

            editBtn.innerText = "Edit";

            editMode = false;

            showSuccess();

        });

    }

});



function showSuccess(){

    const notif = document.createElement('div');

    notif.innerText = "Urutan berhasil diperbarui";

    notif.className =
    "fixed top-6 right-6 bg-green-500 text-white px-4 py-2 rounded shadow transition-opacity duration-500";

    document.body.appendChild(notif);

    setTimeout(function(){

        notif.style.opacity = "0";

        setTimeout(function(){

            notif.remove();

        },500);

    },2000);

}

</script>