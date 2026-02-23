<x-layouts.admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin Tinta Emas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Selamat datang, {{ auth()->user()->name }}</p>
            </div>

            <div class="grid grid-cols-4 gap-4 mt-6">
                <div class="bg-blue-500 text-white p-4 rounded">Schools</div>
                <div class="bg-green-500 text-white p-4 rounded">Teachers</div>
                <div class="bg-yellow-500 text-white p-4 rounded">Majors</div>
                <div class="bg-purple-500 text-white p-4 rounded">Gallery</div>
            </div>

        </div>
    </div>
</x-layouts.admin>
