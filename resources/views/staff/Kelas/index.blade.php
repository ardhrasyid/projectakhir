<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Kelas Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, openAddMember: false, currentKelas: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex items-center">
                            <i class="fas fa-plus mr-2"></i><span>Create Kelas</span>
                        </button>
                    </div>

                    <!-- Modal for Create Kelas -->
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
                                            Create Kelas
                                        </h3>
                                        <div class="mt-2">
                                            <form action="{{ route('staff.kelas.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="nama_kelas"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Kelas</label>
                                                    <input type="text" name="nama_kelas" id="nama_kelas"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="user_name"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Siswa</label>
                                                    <input type="text" id="user_name"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        list="user-options" required>
                                                    <datalist id="user-options">
                                                        @if (is_array($users) || is_object($users))
                                                            @foreach ($users as $user)
                                                                <option data-id="{{ $user->id }}"
                                                                    value="{{ $user->name }}"></option>
                                                            @endforeach
                                                        @endif
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

                                                <div class="flex justify-end">
                                                    <button type="button" @click="openCreate = false"
                                                        class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
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

                    <!-- Modal for Edit Kelas -->
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
                                            Edit Kelas
                                        </h3>
                                        <div class="mt-2">
                                            <form :action="'/staff/kelas/' + currentKelas.id_kelas" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="nama_kelas"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Kelas</label>
                                                    <input type="text" name="nama_kelas" id="nama_kelas"
                                                        x-model="currentKelas.nama_kelas"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="user_name_edit"
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                                        Siswa</label>
                                                    <input type="text" id="user_name_edit"
                                                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                        list="user-options-edit" x-model="currentKelas.user.name"
                                                        required>
                                                    <datalist id="user-options-edit"
                                                        class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg">
                                                        @if (is_array($users) || is_object($users))
                                                            @foreach ($users as $user)
                                                                <option data-id="{{ $user->id }}"
                                                                    value="{{ $user->name }}"
                                                                    class="p-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </datalist>
                                                    <input type="hidden" name="user_id" id="user_id_edit"
                                                        x-model="currentKelas.user_id">
                                                </div>

                                                <script>
                                                    document.getElementById('user_name_edit').addEventListener('input', function() {
                                                        var input = this.value;
                                                        var options = document.getElementById('user-options-edit').options;
                                                        for (var i = 0; i < options.length; i++) {
                                                            if (options[i].value === input) {
                                                                document.getElementById('user_id_edit').value = options[i].getAttribute('data-id');
                                                                break;
                                                            }
                                                        }
                                                    });
                                                </script>

                                                <div class="flex justify-end">
                                                    <button type="button" @click="openEdit = false"
                                                        class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
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

                    <!-- Modal for Delete Kelas -->
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
                                            Delete Kelas
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Yakin Menghapus Data?
                                            </p>
                                            <form :action="'/staff/kelas/' + currentKelas.id_kelas" method="POST">
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
                                    <th scope="col" class="px-6 py-3">Kelas</th>
                                    <th scope="col" class="px-6 py-3">Wali Kelas</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_array($kelas) || is_object($kelas))
                                    @foreach ($kelas as $kelasItem)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $kelasItem->nama_kelas }}
                                            </td>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $kelasItem->user->name }}
                                            </td>
                                            <td class="flex items-center px-6 py-4">
                                                <button @click="openEdit = true; currentKelas = {{ $kelasItem }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                                </button>
                                                <button @click="openDelete = true; currentKelas = {{ $kelasItem }}"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ms-3 flex items-center">
                                                    <i class="fas fa-trash-alt mr-2"></i>Remove
                                                </button>
                                                <a href="{{ route('staff.kelas.showAnggota', $kelasItem->id_kelas) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ms-3 flex items-center">
                                                    <i class="fas fa-users mr-2"></i>Lihat Anggota
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
