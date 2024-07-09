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
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah Data</button>
                    </div>

                    <!-- Modal for Create Pelanggaran -->
                    <div x-show="openCreate"
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
                                            Create Pelanggaran
                                        </h3>
                                        <div class="mt-2">
                                            <form action="{{ route('staff.pelanggaran.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="nama_pelanggaran"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Pelanggaran</label>
                                                    <input type="text" name="nama_pelanggaran" id="nama_pelanggaran"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Masukkan nama pelanggaran" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
                                                    <input type="text" name="nama_siswa" id="nama_siswa" list="siswaList"
                                                           class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                           placeholder="Masukkan Nama Siswa" required>
                                                    <datalist id="siswaList">
                                                        @foreach ($users as $user)
                                                            @if ($user->role == 3)
                                                                <option value="{{ $user->name }}" data-id="{{ $user->id }}"></option>
                                                            @endif
                                                        @endforeach
                                                    </datalist>
                                                    <input type="hidden" name="user_id" id="user_id" required>
                                                </div>
                                                
                                                <script>
                                                    document.getElementById('nama_siswa').addEventListener('input', function () {
                                                        var input = this.value;
                                                        var list = document.getElementById('siswaList').options;
                                                        var userIdField = document.getElementById('user_id');
                                                        
                                                        userIdField.value = ''; // Reset user_id field
                                                        
                                                        for (var i = 0; i < list.length; i++) {
                                                            if (list[i].value === input) {
                                                                userIdField.value = list[i].getAttribute('data-id');
                                                                break;
                                                            }
                                                        }
                                                    });
                                                </script>

                                                <div class="mb-4">
                                                    <label for="tanggal"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                                                    <input type="date" name="tanggal" id="tanggal"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Pilih tanggal" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="jenis"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                                    <select name="jenis" id="jenis"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="" disabled selected>Pilih Kategori Pelanggaran</option>
                                                        <option value="Ringan">Ringan</option>
                                                        <option value="Berat">Berat</option>
                                                        <option value="Sangat Berat">Sangat Berat</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="sanksi"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sanksi</label>
                                                    <input type="text" name="sanksi" id="sanksi"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Masukkan sanksi yang diberikan" required>
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
                                        <!-- Modal for Edit Pelanggaran -->
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
                                            Edit Pelanggaran
                                        </h3>
                                        <div class="mt-2">
                                            <form :action="'/staff/pelanggaran/' + currentPelanggaran.id" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="nama_pelanggaran"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Pelanggaran</label>
                                                    <input type="text" name="nama_pelanggaran" id="nama_pelanggaran"
                                                        x-model="currentPelanggaran.nama_pelanggaran"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Masukkan nama pelanggaran" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
                                                    <input type="text" name="nama_siswa" id="nama_siswa" list="siswaList"
                                                           x-model="currentPelanggaran.user.name"
                                                           class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                           placeholder="Masukkan Nama Siswa" required>
                                                    <datalist id="siswaList">
                                                        @foreach ($users as $user)
                                                            @if ($user->role == 3)
                                                                <option value="{{ $user->name }}" data-id="{{ $user->id }}"></option>
                                                            @endif
                                                        @endforeach
                                                    </datalist>
                                                    <input type="hidden" name="user_id" id="user_id" x-model="currentPelanggaran.user_id" required>
                                                </div>
                                                
                                                <script>
                                                    document.getElementById('nama_siswa').addEventListener('input', function () {
                                                        var input = this.value;
                                                        var list = document.getElementById('siswaList').options;
                                                        var userIdField = document.getElementById('user_id');
                                                        
                                                        userIdField.value = ''; // Reset user_id field
                                                        
                                                        for (var i = 0; i < list.length; i++) {
                                                            if (list[i].value === input) {
                                                                userIdField.value = list[i].getAttribute('data-id');
                                                                break;
                                                            }
                                                        }
                                                    });
                                                </script>
                                                
                                                <div class="mb-4">
                                                    <label for="tanggal"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                                                    <input type="date" name="tanggal" id="tanggal"
                                                        x-model="currentPelanggaran.tanggal"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Pilih tanggal" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="jenis"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                                    <select name="jenis" id="jenis"
                                                        x-model="currentPelanggaran.jenis"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                        <option value="" disabled selected>Pilih Kategori Pelanggaran</option>
                                                        <option value="Ringan">Ringan</option>
                                                        <option value="Berat">Berat</option>
                                                        <option value="Sangat Berat">Sangat Berat</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="sanksi"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sanksi</label>
                                                    <input type="text" name="sanksi" id="sanksi"
                                                        x-model="currentPelanggaran.sanksi"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        placeholder="Masukkan sanksi yang diberikan" required>
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button" @click="openEdit = false"
                                                        class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
                                                    <button type="submit"
                                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Delete Pelanggaran -->
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
                                            Delete Pelanggaran
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Yakin Menghapus Data?
                                            </p>
                                            <form :action="'/staff/pelanggaran/' + currentPelanggaran.id"
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
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggaran as $pelanggaranItem)
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
                                        <button
                                            @click="openEdit = true; currentPelanggaran = {{ json_encode($pelanggaranItem) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                            <i class="fas fa-edit mr-2"></i>
                                            Edit
                                        </button>
                                        <button
                                            @click="openDelete = true; currentPelanggaran = {{ json_encode($pelanggaranItem) }}"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ms-3 flex items-center">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Hapus
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