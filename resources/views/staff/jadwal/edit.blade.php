<!-- Modal for Edit Jadwal -->
<div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto" @click.away="openEdit = false">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                        Edit Jadwal
                    </h3>
                    <div class="mt-2">
                        <form :action="'/staff/jadwal/' + currentJadwal.id" method="POST" @submit.prevent="openEdit = false; $event.target.submit()">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="id_kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kelas</label>
                                <select id="id_kelas" name="id_kelas" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id_kelas }}" :selected="currentJadwal.id_kelas == {{ $kelasItem->id_kelas }}">
                                            {{ $kelasItem->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="id_mapel" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Mapel</label>
                                <select id="id_mapel" name="id_mapel" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="updateGuruOptions()">
                                    <option value="">Pilih Mapel - Nama Guru</option>
                                    @foreach ($mapels as $mapelItem)
                                        <option value="{{ $mapelItem->id_mapel }}" data-guru="{{ $mapelItem->user ? $mapelItem->user->id : '' }}" data-guru-name="{{ $mapelItem->user ? $mapelItem->user->name : '' }}" :selected="currentJadwal.id_mapel == {{ $mapelItem->id_mapel }}">
                                            {{ $mapelItem->nama_mapel }} - {{ $mapelItem->user ? $mapelItem->user->name : 'Tidak ada guru' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="hari" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Hari</label>
                                <select id="hari" name="hari" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="1" :selected="currentJadwal.hari == 1">Senin</option>
                                    <option value="2" :selected="currentJadwal.hari == 2">Selasa</option>
                                    <option value="3" :selected="currentJadwal.hari == 3">Rabu</option>
                                    <option value="4" :selected="currentJadwal.hari == 4">Kamis</option>
                                    <option value="5" :selected="currentJadwal.hari == 5">Jumat</option>
                                    <option value="6" :selected="currentJadwal.hari == 6">Sabtu</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="pukul" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Pukul</label>
                                <select id="pukul" name="pukul" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="07:00 - 07:45" :selected="currentJadwal.pukul == '07:00 - 07:45'">07:00 - 07:45</option>
                                    <option value="07:45 - 08:30" :selected="currentJadwal.pukul == '07:45 - 08:30'">07:45 - 08:30</option>
                                    <option value="08:30 - 09:15" :selected="currentJadwal.pukul == '08:30 - 09:15'">08:30 - 09:15</option>
                                    <option value="10:00 - 10:45" :selected="currentJadwal.pukul == '10:00 - 10:45'">10:00 - 10:45</option>
                                    <option value="10:45 - 11:30" :selected="currentJadwal.pukul == '10:45 - 11:30'">10:45 - 11:30</option>
                                    <option value="11:30 - 12:15" :selected="currentJadwal.pukul == '11:30 - 12:15'">11:30 - 12:15</option>
                                    <option value="13:00 - 13:45" :selected="currentJadwal.pukul == '13:00 - 13:45'">13:00 - 13:45</option>
                                    <option value="13:45 - 14:30" :selected="currentJadwal.pukul == '13:45 - 14:30'">13:45 - 14:30</option>
                                    <option value="14:30 - 15:15" :selected="currentJadwal.pukul == '14:30 - 15:15'">14:30 - 15:15</option>
                                    <option value="15:15 - 16:00" :selected="currentJadwal.pukul == '15:15 - 16:00'">15:15 - 16:00</option>
                                </select>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Simpan
                                </button>
                                <button @click="openEdit = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


