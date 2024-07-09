<x-app-layout>
    <div class="py-12" x-data="{ openCreate: false, openEdit: false, openDelete: false, openDetail: false, currentUser: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Start Modal Create -->

                <!-- Modal for Create Staff -->
                <div x-show="openCreate" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title"
                    role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="openCreate" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                            aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Tambah Data</h3>
                                    <div class="mt-2">
                                        <form method="POST" action="{{ route('staff.user.storeStaff') }}">
                                            @csrf
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="name">Name</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="name" type="text" name="name" required
                                                    placeholder="Masukkan nama lengkap">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Nama wajib diisi.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="username">NIP</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="username" type="text" name="username" required
                                                    placeholder="Masukkan NIP">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">NIP wajib diisi.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="email">Email</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="email" type="email" name="email" required
                                                    placeholder="Masukkan email">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Email wajib diisi.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="password">Password</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="password" type="password" name="password" required
                                                    placeholder="Masukkan password">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Password wajib diisi.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="password_confirmation">Confirm Password</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="password_confirmation" type="password"
                                                    name="password_confirmation" required
                                                    placeholder="Konfirmasi password">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Konfirmasi password wajib diisi.
                                                </p>
                                            </div>
                                            <input type="hidden" name="role" value="1">

                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="jenis_kelamin">Jenis Kelamin</label>
                                                <select
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="1">Laki-Laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Jenis kelamin wajib dipilih.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="agama">Agama</label>
                                                <select
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="agama" name="agama" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="2">Kristen</option>
                                                    <option value="3">Katolik</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Buddha</option>
                                                    <option value="6">Konghucu</option>
                                                </select>
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Agama wajib dipilih.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="alamat">Alamat</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="alamat" type="text" name="alamat"
                                                    placeholder="Masukkan alamat">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">Alamat wajib diisi.</p>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="no_telp">No Telp</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="no_telp" type="text" name="no_telp"
                                                    placeholder="Masukkan no telp">
                                                <p class="text-red-500 text-xs italic"
                                                    x-show="!$el.value && $el.touched">No telp wajib diisi.</p>
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <button @click="openCreate = false" type="button"
                                                    class="text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-900 font-medium rounded-lg text-sm px-4 py-2 mr-2">Cancel</button>
                                                <button type="submit"
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification for Success -->
                <div x-data="{ notificationSuccess: @json(Session::has('success')) }" x-show="notificationSuccess" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Data Berhasil Ditambahkan</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('success') }}
                                        </p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationSuccess = false" type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification for Failure -->
                <div x-data="{ notificationFailure: @json(Session::has('error')) }" x-show="notificationFailure" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Data Gagal Ditambahkan</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('error') }}</p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationFailure = false" type="button"
                                            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Modal Create -->

                <!-- Start Modal Edit -->
                
                <!-- Modal for Edit Staff -->
                <div x-show="openEdit" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title"
                    role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="openEdit" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                            aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Edit Staff</h3>
                                    <div class="mt-2">
                                        <form method="POST" :action="'/staff/user/updateStaff/' + currentUser.id">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="name">Name</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="name" type="text" name="name"
                                                    x-model="currentUser.name" required>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="username">Username</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="username" type="text" name="username"
                                                    x-model="currentUser.username" required>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="email">Email</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="email" type="email" name="email"
                                                    x-model="currentUser.email" required>
                                            </div>
                                            <input type="hidden" name="role" value="1">
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="jenis_kelamin">Jenis Kelamin</label>
                                                <select
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="jenis_kelamin" name="jenis_kelamin"
                                                    x-model="currentUser.staff.jenis_kelamin">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="agama">Agama</label>
                                                <select
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="agama" name="agama" x-model="currentUser.staff.agama">
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="2">Kristen</option>
                                                    <option value="3">Katolik</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Buddha</option>
                                                    <option value="6">Konghucu</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="alamat">Alamat</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="alamat" type="text" name="alamat"
                                                    x-model="currentUser.staff.alamat">
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left"
                                                    for="no_telp">No Telp</label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="no_telp" type="text" name="no_telp"
                                                    x-model="currentUser.staff.no_telp">
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <button @click="openEdit = false" type="button"
                                                    class="text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-900 font-medium rounded-lg text-sm px-4 py-2 mr-2">Cancel</button>
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification for Edit Success -->
                <div x-data="{ notificationEditSuccess: @json(Session::has('edit_success')) }" x-show="notificationEditSuccess" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Data Berhasil Diedit</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('edit_success') }}</p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationEditSuccess = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification for Edit Failure -->
                <div x-data="{ notificationEditFailure: @json(Session::has('edit_error')) }" x-show="notificationEditFailure" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Edit Data Gagal</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('edit_error') }}</p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationEditFailure = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Detail Info -->
                <div x-show="openDetail" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title"
                    role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="openDetail" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                            aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100">
                                    <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Informasi Staff</h3>
                                    <div class="mt-5 grid grid-cols-2 gap-4 border p-4">
                                        <div class="mb-4 col-span-2">
                                            <img :src="currentUser.staff?.foto_url || '{{ asset('img/user.png') }}'"
                                                alt="Foto Pengguna" class="w-32 h-32 rounded-full mx-auto">
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Name</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.name"></p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">NIP</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.username"></p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Email</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.email"></p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Password</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left">*****</p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Role</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.role == 1 ? 'Staff' : 'Other'"></p>
                                        </div>

                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Jenis
                                                Kelamin</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.staff?.jenis_kelamin == 1 ? 'Laki-laki' : currentUser.staff?.jenis_kelamin == 2 ? 'Perempuan' : 'User Belum Melengkapi Data'">
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Agama</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.staff?.agama == 1 ? 'Islam' : currentUser.staff?.agama == 2 ? 'Kristen' : currentUser.staff?.agama == 3 ? 'Katolik' : currentUser.staff?.agama == 4 ? 'Hindu' : currentUser.staff?.agama == 5 ? 'Buddha' : currentUser.staff?.agama == 6 ? 'Konghucu' : 'User Belum Melengkapi Data'">
                                            </p>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">No
                                                Telp</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.staff?.no_telp || 'User Belum Melengkapi Data'">
                                            </p>
                                        </div>
                                        <div class="mb-4 col-span-2">
                                            <label
                                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2 text-left">Alamat</label>
                                            <p class="text-gray-700 dark:text-gray-300 text-left"
                                                x-text="currentUser.staff?.alamat || 'User Belum Melengkapi Data'"></p>
                                        </div>


                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-6">
                                    <button @click="openDetail = false" type="button"
                                        class="text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-900 font-medium rounded-lg text-sm px-4 py-2 mr-2">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Delete Staff -->
                <div x-show="openDelete" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title"
                    role="dialog" aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="openDelete" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                            aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                        id="modal-title">Hapus Data</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Data yang Dihapus Tidak Dapat Dipulihkan</p>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Yakin Menghapus Data?</p>
                                        <form :action="'{{ route('staff.user.destroyStaff', '') }}/' + currentUser.id"
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

                <!-- Notification for Delete Success -->
                <div x-data="{ notificationDeleteSuccess: @json(Session::has('delete_success')) }" x-show="notificationDeleteSuccess" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Data Berhasil Dihapus</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('delete_success') }}</p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationDeleteSuccess = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification for Delete Failure -->
                <div x-data="{ notificationDeleteFailure: @json(Session::has('delete_error')) }" x-show="notificationDeleteFailure" class="fixed z-10 inset-0 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div>
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Hapus Data Gagal</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-300">{{ session('delete_error') }}</p>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button @click="notificationDeleteFailure = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel untuk menampilkan data yang digabungkan -->
                <div class="container mx-auto px-4">
                    <div class="bg-white shadow-lg rounded-lg my-6 overflow-hidden">
                        <div class="px-6 py-4">
                            <!-- Tombol Tambah -->
                            <button @click="openCreate = true"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead
                                class="bg-gradient-to-r from-gray-50 to-gray-200 dark:from-gray-700 dark:to-gray-800">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                        NIP</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                        No Telp</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach ($users as $user)
                                    <tr
                                        class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $user->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $user->username }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $user->email }}</td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            <ul>
                                                @foreach ($user->subroles as $subrole)
                                                    <li>{{ $subrole->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td> --}}
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            @if ($user->staff)
                                                {{ $user->staff->no_telp }}
                                            @else
                                                User Belum Melengkapi Data Diri
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300 space-x-2">
                                            <button @click="openEdit = true; currentUser = {{ $user }};"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button @click="openDelete = true; currentUser = {{ $user }};"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <button @click="openDetail = true; currentUser = {{ $user }};"
                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                                <i class="fas fa-info-circle"></i> Info
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

