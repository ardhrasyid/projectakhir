<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Ekstrakurikuler Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, openViewMembers: false, currentEkstra: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <i class="fas fa-plus mr-2"></i> Tambah Data
                        </button>
                    </div>

                    <!-- Modal for Create Ekstrakurikuler -->
                    <div x-show="openCreate" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Tambah Data Ekstrakurikuler
                                        </h3>
                                        <div class="mt-2">
                                            <form action="{{ route('staff.ekstrakurikuler.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Ekstrakurikuler</label>
                                                    <input type="text" name="nama" id="nama" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pembina</label>
                                                    <input type="text" id="user_name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" list="user-options" required>
                                                    <datalist id="user-options">
                                                        @foreach ($users as $user)
                                                            <option data-id="{{ $user->id }}" value="{{ $user->name }}"></option>
                                                        @endforeach
                                                    </datalist>
                                                    <input type="hidden" name="user_id" id="user_id">
                                                </div>
                                                
                                                <script>
                                                    document.getElementById('user_name').addEventListener('input', function() {
                                                        var input = this.value;
                                                        var options = document.getElementById('user-options').options;
                                                        for (var i = 0; i < options.length; i++) {
                                                            if (options[i].value === input) {
                                                                document.getElementById('user_id').value = options[i].getAttribute('data-id');
                                                                break;
                                                            }
                                                        }
                                                    });
                                                </script>
                                                {{-- <div class="mb-4">
                                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                                    <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required></textarea>
                                                </div> --}}
                                                <input type="hidden" name="status" value="1">
                                                {{-- <div class="mb-4">
                                                    <label for="kuota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kuota</label>
                                                    <input type="number" name="kuota" id="kuota" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="0">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="status_pendaftaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pendaftaran</label>
                                                    <select name="status_pendaftaran" id="status_pendaftaran" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                        <option value="open">Open</option>
                                                        <option value="closed">Closed</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="tgl_pendaftaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pendaftaran</label>
                                                    <input type="date" name="tgl_pendaftaran" id="tgl_pendaftaran" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                </div> --}}
                                                <div class="flex justify-end">
                                                    <button type="button" @click="openCreate = false" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Edit Ekstrakurikuler -->
                    <div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Edit Ekstrakurikuler

                                        </h3>
                                        <div class="mt-2">
                                            <form :action="'/staff/ekstrakurikuler/' + currentEkstra.id" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Ekstrakurikuler</label>
                                                    <input type="text" name="nama" id="nama" x-model="currentEkstra.nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                                    <textarea name="deskripsi" id="deskripsi" x-model="currentEkstra.deskripsi" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required></textarea>
                                                </div>
                                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Save
                                                    </button>
                                                    <button @click="openEdit = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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

                    <!-- Modal for Delete Ekstrakurikuler -->
                    <div x-show="openDelete" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Hapus Ekstrakurikuler

                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400" >Yakin Menghapus Data?</p>
                                            <form :action="'/staff/ekstrakurikuler/' + currentEkstra.id" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete
                                                    </button>
                                                    <button @click="openDelete = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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

                    <!-- Modal for View Members -->
                    <div x-show="openViewMembers" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Daftar Anggota
                                        </h3>
                                        <div class="mt-2">
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">No</th>
                                                        <th scope="col" class="px-6 py-3">Nama</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template x-for="(member, index) in currentEkstra.members" :key="member.id">
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="index + 1"></td>
                                                            <td class="px-6 py-4" x-text="member.name"></td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                            <div class="flex justify-end mt-4">
                                                <button @click="openViewMembers = false" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Ekstrakurikuler</th>
                                    <th scope="col" class="px-6 py-3">Pembina</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ekstrakurikuler as $ekstra)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $ekstra->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $ekstra->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center">
                                            {{ $ekstra->status == 1 ? 'Aktif' : 'Berhenti Sementara' }}
                                            <form action="{{ route('staff.ekstrakurikuler.updateStatus', $ekstra->id) }}" method="POST" class="inline flex space-x-3 ml-2">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="{{ $ekstra->status == 1 ? '0' : '1' }}" class="{{ $ekstra->status == 1 ? 'text-green-500 dark:text-green-500 bg-green-200 dark:bg-green-400' : 'text-red-500 dark:text-red-500 bg-red-200 dark:bg-red-400'  }} hover:underline rounded-lg px-3 py-2">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                
                                    <td class="flex items-center px-6 py-4 space-x-3">
                                        
                                        {{-- <button @click="openEdit = true; currentEkstra = {{ $ekstra }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline px-4 py-2 bg-blue-100 dark:bg-blue-700 rounded-md">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </button> --}}
                                        <button @click="openDelete = true; currentEkstra = {{ $ekstra }}" class="font-medium text-red-600 dark:text-red-500 hover:underline px-4 py-2 bg-red-100 dark:bg-red-700 rounded-md">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button @click="openViewMembers = true; currentEkstra = {{ $ekstra }}" class="font-medium text-green-600 dark:text-green-500 hover:underline px-4 py-2 bg-green-100 dark:bg-green-700 rounded-md">
                                            <i class="fas fa-users"></i> Lihat Anggota
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
