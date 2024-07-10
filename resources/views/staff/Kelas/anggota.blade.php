<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Kelas Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form Tambah Anggota Kelas -->
                    <div class="mt-6">
                        <form action="{{ route('staff.kelas.addAnggota', $kelas->id_kelas) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Siswa</label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($siswa as $s)
                                        @if (!$anggotaKelas->pluck('user_id')->contains($s->id) && !$s->anggotaKelas()->exists())
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                    Tambah Anggota
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Tabel Anggota Kelas dan Absensi -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Siswa</th>
                                    <th scope="col" class="px-6 py-3">Kelas</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_array($anggotaKelas) || is_object($anggotaKelas))
                                    @php
                                        $sortedAnggotaKelas = $anggotaKelas->sortBy(function($anggota) {
                                            return $anggota->user->name;
                                        });
                                    @endphp
                                    @foreach ($sortedAnggotaKelas as $index => $anggota)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $anggota->user->name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $kelas->nama_kelas }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{ route('staff.kelas.destroyAnggota', ['kelas' => $kelas->id_kelas, 'anggota' => $anggota->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
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
