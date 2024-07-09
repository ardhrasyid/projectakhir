<x-app-layout>
    <div class="py-12" x-data="editPermissions()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <button @click="openCreate = true" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create User</button>
                    </div>

                    <div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Edit Permissions
                                        </h3>
                                        <div class="mt-2">
                                            <form :action="`{{ url('staff/user') }}/${currentUser.id}/permissions`" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                                    <select name="role" id="role" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required @change="updateSubRoles($event)">
                                                        <option value="1">Staff</option>
                                                        <option value="2">Guru</option>
                                                        <option value="3">Siswa</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="sub_roles" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sub Roles</label>
                                                    <div x-show="subRoles.length > 0">
                                                        <template x-for="subRole in subRoles" :key="subRole.id">
                                                            <div>
                                                                <input type="checkbox" :value="subRole.id" name="sub_roles[]" class="mr-2">
                                                                <label x-text="subRole.name" class="text-gray-700 dark:text-gray-300"></label>
                                                            </div>
                                                        </template>
                                                    </div>
                                                    <div x-show="subRoles.length === 0" class="text-gray-500 dark:text-gray-400">
                                                        Select a role to see sub-roles.
                                                    </div>
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button" @click="openEdit = false" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Cancel</button>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Bagian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        @if($user->role == 1)
                                            Staff
                                        @elseif($user->role == 2)
                                            Guru
                                        @elseif($user->role == 3)
                                            Siswa
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        @foreach($user->subRoles as $subRole)
                                            {{ $subRole->name }},
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button @click="editUser({{ $user }});" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Role</button>
                                        <form action="{{ route('staff.user.destroy', $user) }}" method="POST" class="inline-block">
                                           </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function editPermissions() {
            return {
                openCreate: false,
                openEdit: false,
                openDelete: false,
                currentUser: null,
                subRoles: [],
                subRoleOptions: {
                    1: [
                        { id: 1, name: 'Staff Admin' },
                        { id: 2, name: 'Staff Akademik' },
                        { id: 3, name: 'Staff Kesiswaan' }
                    ],
                    2: [
                        { id: 4, name: 'Guru Mapel' },
                        { id: 5, name: 'Wali Kelas' },
                        { id: 6, name: 'Pembina Ekstra' }
                    ],
                    3: [
                        { id: 7, name: 'Siswa' }
                    ]
                },
                updateSubRoles(event) {
                    const roleId = event.target.value;
                    this.subRoles = this.subRoleOptions[roleId] || [];
                },
                editUser(user) {
                    this.currentUser = user;
                    this.openEdit = true;
                    this.updateSubRoles({ target: { value: user.role } });
                }
            }
        }
    </script>
</x-app-layout>
