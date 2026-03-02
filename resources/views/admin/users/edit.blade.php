<x-layouts.admin>

<x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800">
        Edit User
    </h2>
</x-slot>

<div class="bg-white p-6 rounded-xl shadow max-w-2xl">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="userForm"
          method="POST"
          action="{{ route('admin.users.update',$user->id) }}">
        @csrf
        @method('PUT')

        <input type="hidden" name="pin_verified" id="pin_verified" value="0">

        {{-- Name --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text"
                value="{{ $user->name }}"
                readonly
                class="w-full bg-gray-100 border rounded-lg p-2 text-gray-500">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email"
                value="{{ $user->email }}"
                readonly
                class="w-full bg-gray-100 border rounded-lg p-2 text-gray-500">
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Password Baru (opsional)
            </label>

            <input type="password"
                name="password"
                id="password"
                class="w-full border rounded-lg p-2">

            <p class="text-red-500 text-xs mt-1 hidden"
               id="passwordError">
                Minimal 8 karakter, huruf besar, huruf kecil, angka dan simbol.
            </p>
        </div>

        {{-- Role --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Role</label>

            <select name="role"
                    id="role"
                    class="w-full border rounded-lg p-2">

                @foreach($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.users.index') }}"
               class="text-gray-500 hover:underline">
                ← Kembali
            </a>

            <button type="button"
                id="updateBtn"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Update
            </button>
        </div>

    </form>

</div>


<!-- PIN MODAL -->
<div id="pinModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-lg p-6 w-96">

        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Konfirmasi PIN Super Admin
        </h3>

        <input type="password"
               id="pinInput"
               placeholder="Masukkan PIN"
               class="w-full border rounded-lg p-2 mb-4 focus:ring focus:ring-red-200">

        <div id="pinError"
             class="text-red-500 text-sm mb-3 hidden">
            PIN salah!
        </div>

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded-lg">
                Batal
            </button>

            <button onclick="confirmPin()"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">
                Konfirmasi
            </button>
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('userForm');
    const updateBtn = document.getElementById('updateBtn');
    const roleSelect = document.getElementById('role');

    const pinModal = document.getElementById('pinModal');
    const pinInput = document.getElementById('pinInput');
    const pinError = document.getElementById('pinError');

    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');

    function validatePassword() {

        if (passwordInput.value.trim() === '') {
            passwordError.classList.add('hidden');
            passwordInput.classList.remove('border-red-500');
            return true;
        }

        const v = passwordInput.value;

        const valid =
            v.length >= 8 &&
            /[a-z]/.test(v) &&
            /[A-Z]/.test(v) &&
            /[0-9]/.test(v) &&
            /[@$!%*#?&]/.test(v);

        if (!valid) {
            passwordError.classList.remove('hidden');
            passwordInput.classList.add('border-red-500');
            return false;
        }

        passwordError.classList.add('hidden');
        passwordInput.classList.remove('border-red-500');
        return true;
    }

    updateBtn.addEventListener('click', function () {

        if (!validatePassword()) return;

        if (roleSelect.value === 'super-admin') {
            pinModal.classList.remove('hidden');
            pinModal.classList.add('flex');
        } else {
            form.submit();
        }
    });

    window.closeModal = function () {
        pinModal.classList.add('hidden');
        pinModal.classList.remove('flex');
        pinInput.value = '';
        pinError.classList.add('hidden');
    };

    window.confirmPin = function () {

        fetch("{{ route('admin.users.verifyPin') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                pin: pinInput.value
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('pin_verified').value = "1";
                form.submit();
            } else {
                pinError.classList.remove('hidden');
            }
        });
    };

});
</script>

</x-layouts.admin>