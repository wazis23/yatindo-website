<x-layouts.admin>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Tambah User
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded-xl shadow max-w-2xl">

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="userForm" method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <input type="hidden" name="pin_verified" id="pin_verified" value="0">
            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama</label>

                <input type="text"
                    name="name"
                    id="name"
                    required
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                <p class="text-red-500 text-xs mt-1 hidden" id="nameError">
                    Nama wajib diisi
                </p>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>

                <input type="email"
                    name="email"
                    id="email"
                    required
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                <p class="text-red-500 text-xs mt-1 hidden" id="emailError">
                    Format email tidak valid
                </p>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>

                <input type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                <p class="text-red-500 text-xs mt-1 hidden" id="passwordError">
                    Minimal 8 karakter, huruf besar, huruf kecil, angka dan simbol.
                </p>
            </div>

            {{-- Role --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Role</label>

                <select name="role"
                        id="role"
                        required
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Role --</option>
                    <option value="super-admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="content-maker">Content Maker</option>
                </select>

                <p class="text-red-500 text-xs mt-1 hidden" id="roleError">
                    Role wajib dipilih
                </p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.users.index') }}"
                   class="text-gray-500 hover:underline">
                    ← Kembali
                </a>

                <button type="button"
        id="submitBtn"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
    Simpan
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
    const submitBtn = document.getElementById('submitBtn');
    const roleSelect = document.getElementById('role');

    const pinModal = document.getElementById('pinModal');
    const pinInput = document.getElementById('pinInput');
    const pinError = document.getElementById('pinError');

    const fields = {
        name: {
            input: document.getElementById('name'),
            error: document.getElementById('nameError'),
            touched: false,
            validate() {
                if (this.input.value.trim() === '') {
                    showError(this.input, this.error, "Nama wajib diisi");
                    return false;
                }
                clearError(this.input, this.error);
                return true;
            }
        },
        email: {
            input: document.getElementById('email'),
            error: document.getElementById('emailError'),
            touched: false,
            validate() {
                const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!pattern.test(this.input.value)) {
                    showError(this.input, this.error, "Format email tidak valid");
                    return false;
                }
                clearError(this.input, this.error);
                return true;
            }
        },
        password: {
            input: document.getElementById('password'),
            error: document.getElementById('passwordError'),
            touched: false,
            validate() {
                const v = this.input.value;
                const valid =
                    v.length >= 8 &&
                    /[a-z]/.test(v) &&
                    /[A-Z]/.test(v) &&
                    /[0-9]/.test(v) &&
                    /[@$!%*#?&]/.test(v);

                if (!valid) {
                    showError(this.input, this.error,
                        "Minimal 8 karakter, huruf besar, huruf kecil, angka dan simbol.");
                    return false;
                }
                clearError(this.input, this.error);
                return true;
            }
        },
        role: {
            input: document.getElementById('role'),
            error: document.getElementById('roleError'),
            touched: false,
            validate() {
                if (this.input.value === '') {
                    showError(this.input, this.error, "Role wajib dipilih");
                    return false;
                }
                clearError(this.input, this.error);
                return true;
            }
        }
    };

    function showError(input, errorElement, message) {
        input.classList.add('border-red-500');
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
    }

    function clearError(input, errorElement) {
        input.classList.remove('border-red-500');
        errorElement.classList.add('hidden');
    }

    // Attach blur event (hanya saat sudah disentuh)
    Object.values(fields).forEach(field => {

        field.input.addEventListener('blur', function () {
            field.touched = true;
            field.validate();
        });

        field.input.addEventListener('input', function () {
            if (field.touched) {
                field.validate();
            }
        });

    });

    function validateAll() {
        let valid = true;
        Object.values(fields).forEach(field => {
            field.touched = true;
            if (!field.validate()) {
                valid = false;
            }
        });
        return valid;
    }

    submitBtn.addEventListener('click', function () {

        if (!validateAll()) return;

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
            body: JSON.stringify({ pin: pinInput.value })
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