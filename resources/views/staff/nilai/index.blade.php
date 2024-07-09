<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <!-- Filter Kelas -->
                    <form action="{{ route('staff.nilai.index') }}" method="GET">
                        <select name="kelas" id="kelas" onchange="this.form.submit()" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $item)
                                <option value="{{ $item->id }}" @if(request('kelas') == $item->id) selected @endif>{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </form>
                    
                    <!-- Nilai Table -->
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-300 tracking-wider">Nama Siswa</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-300 tracking-wider">Mata Pelajaran</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-300 tracking-wider">Nilai</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilai as $nilai)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $nilai->siswa->name }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $nilai->mapel->nama_mapel }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">{{ $nilai->nilai }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">
                                            <button @click="openEditModal({{ $nilai }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            <button @click="openDeleteModal({{ $nilai }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal for Create/Edit/Delete... -->
                    <!-- Your existing modal code -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

