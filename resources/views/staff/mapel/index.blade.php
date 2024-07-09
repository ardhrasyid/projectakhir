<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Mapel Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, currentMapel: { id_mapel: null, nama_mapel: '', user: { id: null, name: '' } } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex items-center">
                            <i class="fas fa-plus mr-2"></i><span>Create Mapel</span>
                        </button>
                    </div>

                    <!-- Modal for Create Mapel -->
                    <div x-show="openCreate" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Create Mapel
                                        </h3>
                                        <div class="mt-2">
                                            <form action="{{ route('staff.mapel.store') }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="nama_mapel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Mapel</label>
                                                    <input type="text" name="nama_mapel" id="nama_mapel" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengajar</label>
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
                                                
                                                <div class="flex justify-end">
                                                    <button type="button" @click="openCreate = false" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">Create</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Edit Mapel -->
                    <div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Edit Mapel
                                        </h3>
                                        <div class="mt-2">
                                            <form :action="'/staff/mapel/' + currentMapel.id_mapel" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="nama_mapel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Mapel</label>
                                                    <input type="text" name="nama_mapel" id="nama_mapel" x-model="currentMapel.nama_mapel" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="user_name_edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengajar</label>
                                                    <input type="text" id="user_name_edit" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" list="user-options-edit" x-model="currentMapel.user ? currentMapel.user.name : ''" required>
                                                    <datalist id="user-options-edit">
                                                        @foreach ($users as $user)
                                                            <option data-id="{{ $user->id }}" value="{{ $user->name }}"></option>
                                                        @endforeach
                                                    </datalist>
                                                    <input type="hidden" name="user_id" id="user_id_edit" x-model="currentMapel.user.id">
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

                    <!-- Modal for Delete Mapel -->
                    <div x-show="openDelete" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Delete Mapel

                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-400" >Yakin Menghapus Data?</p>
                                            <form :action="'/staff/mapel/' + currentMapel.id_mapel" method="POST">
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

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Mapel</th>
                                    <th scope="col" class="px-6 py-3">Pengajar</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $mapelItem)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $mapelItem->nama_mapel }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$mapelItem->user->name}}
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <button @click="openEdit = true; currentMapel = { id_mapel: {{ $mapelItem->id_mapel }}, nama_mapel: '{{ $mapelItem->nama_mapel }}', user: { id: {{ $mapelItem->user->id }}, name: '{{ $mapelItem->user ? $mapelItem->user->name : '' }}' } }" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                            <i class="fas fa-pencil-alt mr-2"></i>Edit
                                        </button>
                                        <button @click="openDelete = true; currentMapel = { id_mapel: {{ $mapelItem->id_mapel }}, nama_mapel: '{{ $mapelItem->nama_mapel }}', user: { name: '{{ $mapelItem->user ? $mapelItem->user->name : '' }}' } }" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ms-3 flex items-center">
                                            <i class="fas fa-trash-alt mr-2"></i>Remove
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
