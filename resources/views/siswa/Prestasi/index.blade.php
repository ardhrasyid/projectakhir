<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Prestasi Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, currentPrestasi: null, openPdfViewer: false, pdfUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Prestasi
                        </button>
                    </div>

                    <!-- Modal for Create Prestasi -->
                    <div x-show="openCreate"
                        class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full mt-20">
                            <div
                                class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 overflow-y-auto max-h-screen">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                            id="modal-title">
                                            Create Prestasi
                                        </h3>
                                        <div class="mt-2">
                                            <form action="{{ route('siswa.prestasi.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <div class="mb-4">
                                                    <label for="nama_prestasi"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Prestasi</label>
                                                    <input type="text" name="nama_prestasi" id="nama_prestasi"
                                                        placeholder="Inputkan nama prestasi"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="kategori"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                                    <select name="kategori" id="kategori"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="">Pilih Kategori Prestasi</option>
                                                        <option value="Akademik">Akademik</option>
                                                        <option value="Non-Akademik">Non-Akademik</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tingkat"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat</label>
                                                    <select name="tingkat" id="tingkat"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="">Pilih Tingkatan Prestasi</option>
                                                        <option value="Sekolah">Sekolah</option>
                                                        <option value="Kecamatan">Kecamatan</option>
                                                        <option value="Kota/Kabupaten">Kota/Kabupaten</option>
                                                        <option value="Provinsi">Provinsi</option>
                                                        <option value="Nasional">Nasional</option>
                                                        <option value="Internasional">Internasional</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tahun"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun</label>
                                                    <select name="tahun" id="tahun"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="">Pilih Tahun Prestasi</option>
                                                        @for ($year = date('Y'); $year >= 2000; $year--)
                                                            <option value="{{ $year }}">{{ $year }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <input type="hidden" name="status" value="0">
                                                
                                                <div class="mb-4">
                                                    <label for="bukti"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload file</label>
                                                    <input id="bukti" type="file" name="bukti" accept="application/pdf" required
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button" @click="openCreate = false"
                                                        class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
                                                    <button type="submit"
                                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Edit Prestasi -->
                    <div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                            id="modal-title">
                                            Edit Prestasi
                                        </h3>
                                        <div class="mt-2">
                                            <form :action="'/staff/prestasi/' + currentPrestasi.id"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <div class="mb-4">
                                                    <label for="nama_prestasi"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Prestasi</label>
                                                    <input type="text" name="nama_prestasi" id="nama_prestasi"
                                                        x-model="currentPrestasi.nama_prestasi"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="kategori"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                                    <input type="text" name="kategori" id="kategori"
                                                        x-model="currentPrestasi.kategori"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tingkat"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat</label>
                                                    <input type="text" name="tingkat" id="tingkat"
                                                        x-model="currentPrestasi.tingkat"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tahun"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun</label>
                                                    <input type="number" name="tahun" id="tahun"
                                                        x-model="currentPrestasi.tahun"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="bukti"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bukti</label>
                                                    <input type="file" name="bukti" id="bukti"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div>
                                                <div
                                                    class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Save
                                                    </button>
                                                    <button @click="openEdit = false" type="button"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Delete Prestasi -->
                    <div x-show="openDelete"
                        class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                            id="modal-title">
                                            Delete Prestasi
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Yakin Menghapus Data?
                                            </p>
                                            <form :action="'/staff/prestasi/' + currentPrestasi.id"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div
                                                    class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete
                                                    </button>
                                                    <button @click="openDelete = false" type="button"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for PDF Viewer -->
                    <div x-show="openPdfViewer"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity">
                        <div class="absolute top-0 right-0 m-4">
                            <button @click="openPdfViewer = false"
                                class="text-white hover:text-gray-300 focus:outline-none focus:text-gray-300">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl w-11/12 h-5/6">
                            <iframe :src="pdfUrl" class="w-full h-full" frameborder="0"></iframe>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Prestasi</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Tingkat</th>
                                    <th scope="col" class="px-6 py-3">Tahun</th>
                                    <th scope="col" class="px-6 py-3">Bukti</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasi as $prestasiItem)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $prestasiItem->user->name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $prestasiItem->nama_prestasi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prestasiItem->kategori }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prestasiItem->tingkat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prestasiItem->tahun }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button
                                                @click="openPdfViewer = true; pdfUrl = '{{ asset('storage/' . $prestasiItem->bukti) }}'"
                                                class="text-white bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 rounded-lg px-3 py-2">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($prestasiItem->status == 0)
                                                Menunggu Validasi
                                            @elseif($prestasiItem->status == 1)
                                                Tervalidasi
                                            @elseif($prestasiItem->status == 2)
                                                Validasi Di Tolak
                                            @else
                                                Status tidak diketahui
                                            @endif
                                        </td>
                                        <td class="flex items-center px-6 py-4">
                                            
                                                <button @click="openDelete = true; currentPrestasi = {{ $prestasiItem }}"
                                                class="text-red-600 dark:text-red-500 hover:underline ms-3 bg-red-100 dark:bg-red-700 rounded-lg px-3 py-2">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

