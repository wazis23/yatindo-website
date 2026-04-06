<x-layouts.admin>

    <x-slot name="header">
        <h1 class="text-xl font-bold">Mata Pelajaran</h1>

        <a href="{{ route('admin.subjects.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Mapel
        </a>
    </x-slot>
        @php
        function sortLink($column) {
            $currentSort = request('sort_by');
            $currentDir  = request('sort_dir');

            if ($currentSort === $column && $currentDir === 'asc') {
                $dir = 'desc';
            } else {
                $dir = 'asc';
            }

            return request()->fullUrlWithQuery([
                'sort_by' => $column,
                'sort_dir' => $dir
            ]);
        }

        function sortIcon($column) {
                if (request('sort_by') === $column) {
                    return request('sort_dir') === 'asc' ? '↑' : '↓';
                }
                return '↕';
            }
        @endphp
        <form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">

            {{-- DROPDOWN FILTER --}}
            <select name="filter"
                class="border rounded-lg px-3 py-2">

                <option value="">-- Filter --</option>

                <option value="name" {{ request('filter')=='name'?'selected':'' }}>
                    Mata Pelajaran
                </option>

                <option value="unit" {{ request('filter')=='unit'?'selected':'' }}>
                    Unit
                </option>

                <option value="major" {{ request('filter')=='major'?'selected':'' }}>
                    Jurusan
                </option>

                <option value="type" {{ request('filter')=='type'?'selected':'' }}>
                    Tipe
                </option>

            </select>

            {{-- INPUT --}}
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Masukkan keyword..."
                class="border rounded-lg px-3 py-2 w-64">

            {{-- BUTTON --}}
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                🔍 Cari
            </button>

            {{-- RESET --}}
            <a href="{{ route('admin.subjects.index') }}"
            class="px-4 py-2 border rounded-lg hover:bg-gray-100">
            Reset
            </a>

        </form>
    <div class="bg-white rounded-2xl shadow p-6">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b text-left text-gray-500">

                        <th>
                            <a href="{{ sortLink('name') }}" class="flex items-center gap-1">
                                Mata Pelajaran {{ sortIcon('name') }}
                            </a>
                        </th>

                        <th>
                            <a href="{{ sortLink('major') }}" class="flex items-center gap-1">
                                Jurusan {{ sortIcon('major') }}
                            </a>
                        </th>

                        <th>
                            <a href="{{ sortLink('unit') }}" class="flex items-center gap-1">
                                Unit {{ sortIcon('unit') }}
                            </a>
                        </th>

                        <th>
                            <a href="{{ sortLink('type') }}" class="flex items-center gap-1">
                                Tipe {{ sortIcon('type') }}
                            </a>
                        </th>

                        <th>
                            <a href="{{ sortLink('is_active') }}" class="flex items-center gap-1">
                                Status {{ sortIcon('is_active') }}
                            </a>
                        </th>

                        <th class="text-right">Aksi</th>

                    </tr>
                    </thead>

                <tbody class="divide-y">

                    @forelse($subjects as $subject)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="py-3 font-medium">
                                {{ $subject->name }}
                            </td>

                            <td>
                                <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                     {{ optional($subject->major)->name ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                                    {{ strtoupper($subject->unit) }}
                                </span>
                            </td>

                            <td>
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $subject->type == 'produktif' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($subject->type) }}
                                </span>
                            </td>

                            <td>
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $subject->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $subject->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="text-right space-x-2">

                                <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                                   class="text-blue-600 hover:underline">
                                   Edit
                                </a>

                                <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                Belum ada data mata pelajaran
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</x-layouts.admin>