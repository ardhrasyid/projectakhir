<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, currentJadwal: null, showTable: {{ request('id_kelas') ? 'true' : 'false' }} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="GET" action="{{ route('staff.jadwal.index') }}">
                    <div class="mb-4 flex items-end">
                        <div class="w-full">
                            <label for="id_kelas" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                            <select name="id_kelas" id="id_kelas"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id_kelas }}"
                                        {{ old('id_kelas', request('id_kelas')) == $k->id_kelas ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ml-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Filter</button>
                        </div>
                    </div>
                </form>

                <template x-if="showTable">
                    <div>
                        <div class="mt-6 flex justify-between">
                            <div>
                                <button @click="openCreate = true"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">Create</button>
                            </div>
                            <div class="tabs flex justify-center space-x-4">
                                <button class="tablinks py-2 px-4 bg-gray-200 rounded-md"
                                    onclick="openDay(event, 'Senin')">Senin</button>
                                <button class="tablinks py-2 px-4 bg-gray-200 rounded-md"
                                    onclick="openDay(event, 'Selasa')">Selasa</button>
                                <button class="tablinks py-2 px-4 bg-gray-200 rounded-md"
                                    onclick="openDay(event, 'Rabu')">Rabu</button>
                                <button class="tablinks py-2 px-4 bg-gray-200 rounded-md"
                                    onclick="openDay(event, 'Kamis')">Kamis</button>
                                <button class="tablinks py-2 px-4 bg-gray-200 rounded-md"
                                    onclick="openDay(event, 'Jumat')">Jumat</button>
                            </div>
                        </div>

                        <div id="Senin" class="tabcontent mt-4">
                            <h3 class="text-lg font-semibold mb-2">Senin</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mapel</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Guru</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @php
                                        $jadwalsSenin = $jadwals
                                            ->filter(function ($jadwal) {
                                                return $jadwal->hari == 1;
                                            })
                                            ->sortBy('pukul');
                                    @endphp

                                    @foreach ($jadwalsSenin as $index => $jadwal)
                                        @if ($index + 1 != 4 && $index + 1 != 8)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">Senin</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->pukul }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->kelas->nama_kelas }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mapel->nama_mapel }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->user->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <button
                                                        @click="openEdit = true; currentJadwal = {{ $jadwal }}"
                                                        class="text-indigo-600 hover:text-indigo-900">

                                                        <i class="fas fa-edit"></i>

                                                    </button>

                                                </td>

                                            </tr>
                                        @endif

                                        @if ($index + 1 == 3)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">4</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Senin</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">09:15 - 10:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @elseif ($index + 1 == 7)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">8</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Senin</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">12:15 - 13:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div id="Selasa" class="tabcontent mt-4">
                            <h3 class="text-lg font-semibold mb-2">Selasa</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mapel</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Guru</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @php
                                        $jadwalsSelasa = $jadwals
                                            ->filter(function ($jadwal) {
                                                return $jadwal->hari == 2;
                                            })
                                            ->sortBy('pukul');
                                    @endphp

                                    @foreach ($jadwalsSelasa as $index => $jadwal)
                                        @if ($index + 1 != 4 && $index + 1 != 8)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">Selasa</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->pukul }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->kelas->nama_kelas }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->nama_mapel }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->user->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <button
                                                        @click="openEdit = true; currentJadwal = {{ $jadwal }}"
                                                        class="text-indigo-600 hover:text-indigo-900">

                                                        <i class="fas fa-edit"></i>

                                                    </button>

                                                </td>

                                            </tr>
                                        @endif

                                        @if ($index + 1 == 3)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">4</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Selasa</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">09:15 - 10:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @elseif ($index + 1 == 7)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">8</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Selasa</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">12:15 - 13:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div id="Rabu" class="tabcontent mt-4">
                            <h3 class="text-lg font-semibold mb-2">Rabu</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mapel</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Guru</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @php
                                        $jadwalsRabu = $jadwals
                                            ->filter(function ($jadwal) {
                                                return $jadwal->hari == 3;
                                            })
                                            ->sortBy('pukul');
                                    @endphp

                                    @foreach ($jadwalsRabu as $index => $jadwal)
                                        @if ($index + 1 != 4 && $index + 1 != 8)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">Rabu</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->pukul }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->kelas->nama_kelas }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->nama_mapel }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->user->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <button
                                                        @click="openEdit = true; currentJadwal = {{ $jadwal }}"
                                                        class="text-indigo-600 hover:text-indigo-900">

                                                        <i class="fas fa-edit"></i>

                                                    </button>

                                                </td>

                                            </tr>
                                        @endif

                                        @if ($index + 1 == 3)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">4</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Rabu</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">09:15 - 10:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @elseif ($index + 1 == 7)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">8</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Rabu</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">12:15 - 13:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div id="Kamis" class="tabcontent mt-4">
                            <h3 class="text-lg font-semibold mb-2">Kamis</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mapel</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Guru</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @php
                                        $jadwalsKamis = $jadwals
                                            ->filter(function ($jadwal) {
                                                return $jadwal->hari == 4;
                                            })
                                            ->sortBy('pukul');
                                    @endphp

                                    @foreach ($jadwalsKamis as $index => $jadwal)
                                        @if ($index + 1 != 4 && $index + 1 != 8)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">Kamis</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->pukul }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->kelas->nama_kelas }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->nama_mapel }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->user->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <button
                                                        @click="openEdit = true; currentJadwal = {{ $jadwal }}"
                                                        class="text-indigo-600 hover:text-indigo-900">

                                                        <i class="fas fa-edit"></i>

                                                    </button>

                                                </td>

                                            </tr>
                                        @endif

                                        @if ($index + 1 == 3)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">4</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Kamis</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">09:15 - 10:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @elseif ($index + 1 == 7)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">8</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Kamis</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">12:15 - 13:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div id="Jumat" class="tabcontent mt-4">
                            <h3 class="text-lg font-semibold mb-2">Jumat</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kelas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mapel</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Guru</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @php
                                        $jadwalsJumat = $jadwals
                                            ->filter(function ($jadwal) {
                                                return $jadwal->hari == 5;
                                            })
                                            ->sortBy('pukul');
                                    @endphp

                                    @foreach ($jadwalsJumat as $index => $jadwal)
                                        @if ($index + 1 != 4 && $index + 1 != 8)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">Jumat</td>

                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->pukul }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->kelas->nama_kelas }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->nama_mapel }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $jadwal->mapel->user->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <button
                                                        @click="openEdit = true; currentJadwal = {{ $jadwal }}"
                                                        class="text-indigo-600 hover:text-indigo-900">

                                                        <i class="fas fa-edit"></i>

                                                    </button>

                                                </td>

                                            </tr>
                                        @endif

                                        @if ($index + 1 == 3)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">4</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Jumat</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">09:15 - 10:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @elseif ($index + 1 == 7)
                                            <tr>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">8</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">Jumat</td>

                                                <td class="px-6 py-4 whitespace-nowrap bg-red-200">12:15 - 13:00</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-200"
                                                    colspan="4">Istirahat</td>

                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <!-- Modal for Create Jadwal -->
        <div x-show="openCreate" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto" x-cloak>
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
                                Tambah Jadwal
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('staff.jadwal.store') }}" method="POST"
                                    @submit.prevent="openCreate = false; $event.target.submit()">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="id_kelas"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kelas</label>
                                        <select id="id_kelas" name="id_kelas"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            @foreach ($kelas as $kelasItem)
                                                <option value="{{ $kelasItem->id_kelas }}">
                                                    {{ $kelasItem->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="id_mapel"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Mapel</label>
                                        <select id="id_mapel" name="id_mapel"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            onchange="updateGuruOptions()">
                                            <option value="">Pilih Mapel - Nama Guru</option>
                                            @foreach ($mapels as $mapelItem)
                                                <option value="{{ $mapelItem->id_mapel }}"
                                                    data-guru="{{ $mapelItem->user ? $mapelItem->user->id : '' }}"
                                                    data-guru-name="{{ $mapelItem->user ? $mapelItem->user->name : '' }}">
                                                    {{ $mapelItem->nama_mapel }} -
                                                    {{ $mapelItem->user ? $mapelItem->user->name : 'Tidak ada guru' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="hari"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Hari</label>
                                        <select id="hari" name="hari"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jumat</option>
                                            <option value="6">Sabtu</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pukul"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Pukul</label>
                                        <select id="pukul" name="pukul"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="07:00 - 07:45">07:00 - 07:45</option>
                                            <option value="07:45 - 08:30">07:45 - 08:30</option>
                                            <option value="08:30 - 09:15">08:30 - 09:15</option>
                                            <option value="10:00 - 10:45">10:00 - 10:45</option>
                                            <option value="10:45 - 11:30">10:45 - 11:30</option>
                                            <option value="11:30 - 12:15">11:30 - 12:15</option>
                                            <option value="13:00 - 13:45">13:00 - 13:45</option>
                                            <option value="13:45 - 14:30">13:45 - 14:30</option>
                                            <option value="14:30 - 15:15">14:30 - 15:15</option>
                                            <option value="15:15 - 16:00">15:15 - 16:00</option>
                                        </select>
                                    </div>

                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Tambah
                                        </button>
                                        <button @click="openCreate = false" type="button"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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

        <!-- Modal for Edit Jadwal -->
        <div x-show="openEdit" class="fixed z-10 inset-0 flex items-center justify-center overflow-y-auto" x-cloak>
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
                                Edit Jadwal
                            </h3>
                            <div class="mt-2">
                                <form :action="'/staff/jadwal/' + currentJadwal.id" method="POST"
                                    @submit.prevent="openEdit = false; $event.target.submit()">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="id_kelas"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kelas</label>
                                        <select id="id_kelas" name="id_kelas"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            @foreach ($kelas as $kelasItem)
                                                <option value="{{ $kelasItem->id_kelas }}"
                                                    :selected="currentJadwal.id_kelas == {{ $kelasItem->id_kelas }}">
                                                    {{ $kelasItem->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="id_mapel"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Mapel</label>
                                        <select id="id_mapel" name="id_mapel"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            onchange="updateGuruOptions()">
                                            <option value="">Pilih Mapel - Nama Guru</option>
                                            @foreach ($mapels as $mapelItem)
                                                <option value="{{ $mapelItem->id_mapel }}"
                                                    data-guru="{{ $mapelItem->user ? $mapelItem->user->id : '' }}"
                                                    data-guru-name="{{ $mapelItem->user ? $mapelItem->user->name : '' }}"
                                                    :selected="currentJadwal.id_mapel == {{ $mapelItem->id_mapel }}">
                                                    {{ $mapelItem->nama_mapel }} -
                                                    {{ $mapelItem->user ? $mapelItem->user->name : 'Tidak ada guru' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="hari"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Hari</label>
                                        <select id="hari" name="hari"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="1" :selected="currentJadwal.hari == 1">Senin</option>
                                            <option value="2" :selected="currentJadwal.hari == 2">Selasa</option>
                                            <option value="3" :selected="currentJadwal.hari == 3">Rabu</option>
                                            <option value="4" :selected="currentJadwal.hari == 4">Kamis</option>
                                            <option value="5" :selected="currentJadwal.hari == 5">Jumat</option>
                                            <option value="6" :selected="currentJadwal.hari == 6">Sabtu</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pukul"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">Pukul</label>
                                        <select id="pukul" name="pukul"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="07:00 - 07:45"
                                                :selected="currentJadwal.pukul == '07:00 - 07:45'">07:00 - 07:45
                                            </option>
                                            <option value="07:45 - 08:30"
                                                :selected="currentJadwal.pukul == '07:45 - 08:30'">07:45 - 08:30
                                            </option>
                                            <option value="08:30 - 09:15"
                                                :selected="currentJadwal.pukul == '08:30 - 09:15'">08:30 - 09:15
                                            </option>
                                            <option value="10:00 - 10:45"
                                                :selected="currentJadwal.pukul == '10:00 - 10:45'">10:00 - 10:45
                                            </option>
                                            <option value="10:45 - 11:30"
                                                :selected="currentJadwal.pukul == '10:45 - 11:30'">10:45 - 11:30
                                            </option>
                                            <option value="11:30 - 12:15"
                                                :selected="currentJadwal.pukul == '11:30 - 12:15'">11:30 - 12:15
                                            </option>
                                            <option value="13:00 - 13:45"
                                                :selected="currentJadwal.pukul == '13:00 - 13:45'">13:00 - 13:45
                                            </option>
                                            <option value="13:45 - 14:30"
                                                :selected="currentJadwal.pukul == '13:45 - 14:30'">13:45 - 14:30
                                            </option>
                                            <option value="14:30 - 15:15"
                                                :selected="currentJadwal.pukul == '14:30 - 15:15'">14:30 - 15:15
                                            </option>
                                            <option value="15:15 - 16:00"
                                                :selected="currentJadwal.pukul == '15:15 - 16:00'">15:15 - 16:00
                                            </option>
                                        </select>
                                    </div>

                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Simpan
                                        </button>
                                        <button @click="openEdit = false" type="button"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
    </div>


</x-app-layout>

<script>
    function openDay(evt, dayName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(dayName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
