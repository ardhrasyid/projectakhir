<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Guru Ekstrakurikuler Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openViewMembers: false, currentEkstra: null, registered: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($ekstrakurikuler as $ekstra)
                            @if ($ekstra->status == 1)
                                <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-2 sm:px-4">
                                        <h3 class="text-md leading-5 font-medium text-gray-900 dark:text-gray-100">
                                            {{ $ekstra->nama }}
                                        </h3>
                                        <p class="mt-1 max-w-2xl text-xs text-gray-500 dark:text-gray-400">
                                            {{ $ekstra->deskripsi }}
                                        </p>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-gray-700">
                                        <dl>
                                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-4">
                                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-300">
                                                    Pembina
                                                </dt>
                                                <dd class="mt-1 text-xs text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $ekstra->user->name }}
                                                </dd>
                                            </div>
                                            <div class="bg-white dark:bg-gray-800 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-4">
                                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-300">
                                                    Kuota
                                                </dt>
                                                <dd class="mt-1 text-xs text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $ekstra->kuota }}
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-4">
                                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-300">
                                                    Status Pendaftaran
                                                </dt>
                                                <dd class="mt-1 text-xs text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $ekstra->status == 1 ? 'Buka' : 'Tutup' }}
                                                </dd>
                                            </div>
                                            <div class="bg-white dark:bg-gray-800 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-4">
                                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-300">
                                                    Tanggal Pendaftaran Dibuka
                                                </dt>
                                                <dd class="mt-1 text-xs text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $ekstra->tgl_dibuka }}
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-4">
                                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-300">
                                                    Tanggal Pendaftaran Ditutup
                                                </dt>
                                                <dd class="mt-1 text-xs text-gray-900 dark:text-gray-100 sm:mt-0 sm:col-span-2">
                                                    {{ $ekstra->tgl_ditutup }}
                                                </dd>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-right sm:px-6">
                                                @if ($ekstra->status_pendaftaran == 0)
                                                    <div class="text-red-500 dark:text-red-400 text-center py-2 px-4 border border-red-500 dark:border-red-400 rounded-md bg-red-100 dark:bg-red-700">
                                                        <i class="fas fa-exclamation-circle mr-2"></i> Pendaftaran ditutup
                                                    </div>
                                                @elseif ($ekstra->siswaSudahApply(Auth::user()->id))
                                                    <div class="text-yellow-500 dark:text-yellow-400 text-center py-2 px-4 border border-yellow-500 dark:border-yellow-400 rounded-md bg-yellow-100 dark:bg-yellow-700">
                                                        <i class="fas fa-hourglass-half mr-2"></i> Dalam Proses Pendaftaran
                                                    </div>
                                                    @elseif ((new App\Http\Controllers\EkstrakurikulerController)->cekKuotaPenuh($ekstra->id))
                                                    <div class="text-red-500 dark:text-red-400 text-center py-2 px-4 border border-red-500 dark:border-red-400 rounded-md bg-red-100 dark:bg-red-700">
                                                        <i class="fas fa-exclamation-circle mr-2"></i> Kuota penuh
                                                    </div>
                                                @else
                                                    <form action="{{ route('siswa.ekstrakurikuler.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_ekskul" value="{{ $ekstra->id }}">
                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="tanggal_daftar" value="{{ now() }}">
                                                        <input type="hidden" name="status_penerimaan" value="0">
                                                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Apply
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
