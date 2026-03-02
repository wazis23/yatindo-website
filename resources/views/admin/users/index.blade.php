<x-layouts.admin>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manajemen User</h1>

    <a href="{{ route('admin.users.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        + Tambah User
    </a>
</div>

@if(session('success'))
<div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
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
<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100 text-sm">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Email</th>
            <th class="p-3 text-center">Role</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-t">
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3 text-center">
                {{ $user->roles->pluck('name')->first() }}
            </td>
            <td class="p-3 text-center space-x-2">

                <a href="{{ route('admin.users.edit',$user->id) }}"
                class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                    Edit
                </a>

                <form action="{{ route('admin.users.destroy',$user->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                    class="inline-block">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-layouts.admin>