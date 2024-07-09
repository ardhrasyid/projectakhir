<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Pelanggaran Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, currentPelanggaran: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Pelanggaran</th>
                                    <th scope="col" class="px-6 py-3">Nama Siswa</th>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Sanksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggaran as $pelanggaranItem)
                                    @if ($pelanggaranItem->user_id == Auth::id())
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $pelanggaranItem->nama_pelanggaran }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pelanggaranItem->user->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pelanggaranItem->tanggal }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pelanggaranItem->jenis }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pelanggaranItem->sanksi }}
                                            </td>
                                            <td class="flex items-center px-6 py-4">
                                                <!-- CRUD buttons removed as per instruction -->
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


