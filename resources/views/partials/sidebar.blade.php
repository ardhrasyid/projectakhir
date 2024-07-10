<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600">
  <span class="sr-only">Open sidebar</span>
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
  </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="overflow pt-10 mt-5 top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-r from-green-900 to-green-700 dark:from-green-900 dark:to-green-700">
<ul class="space-y-2 font-medium">
    @if(Auth::user()->role == '1')
      <li>
        <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
          <i class="fas fa-home w-5 h-5"></i>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-users w-5 h-5"></i>
          <span class="ms-3">Data Pengguna</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('staff.user.indexStaff') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Staff</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.user.indexGuru') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Guru</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.user.indexSiswa') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Siswa</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-book w-5 h-5"></i>
          <span class="ms-3">Manajemen Akademik</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('staff.mapel.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Mata Pelajaran</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.kelas.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Kelas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.jadwal.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Jadwal</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.ekstrakurikuler.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Nilai</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-user-shield w-5 h-5"></i>
          <span class="ms-3">Manajemen Kesiswaan</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('staff.prestasi.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Prestasi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.pelanggaran.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Pelanggaran</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.ekstrakurikuler.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Ekstrakulikuler</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.absen.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Absen</span>
            </a>
          </li>
        </ul>
      </li>
    @endif

      @if(Auth::user()->role == '2')
      <li>
        <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
          <i class="fas fa-home w-5 h-5"></i>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-chalkboard-teacher w-5 h-5"></i>
          <span class="ms-3">Pengajar</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Jadwal Pelajaran</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Absensi Siswa</span>
            </a>
          </li>
          <li>
            <a href="{{ route('guru.ekstrakurikuler.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Nilai Siswa</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-user-shield w-5 h-5"></i>
          <span class="ms-3">Wali Kelas</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('guru.kelas.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Data Anggota Kelas</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-futbol w-5 h-5"></i>
          <span class="ms-3">Pembina Ekstra</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('guru.ekstrakurikuler.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Ekstrakulikuler</span>
            </a>
          </li>
        </ul>
      </li>
      @endif
    

      @if(Auth::user()->role == '3')
      <li>
        <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
          <i class="fas fa-home w-5 h-5"></i>
          <span class="ms-3">Dashboard</span>
        </a>
      </li> 
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-user-graduate w-5 h-5"></i>
          <span class="ms-3">Siswa</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Jadwal</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Nilai</span>
            </a>
          </li>
          <li>
            <a href="{{ route('siswa.prestasi.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Prestasi</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-user-check w-5 h-5"></i>
          <span class="ms-3">Kedisiplinan</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="#" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Absensi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('siswa.pelanggaran.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Pelanggaran</span>
            </a>
          </li>
        </ul>
      </li>
      <li x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group w-full">
          <i class="fa-solid fa-futbol w-5 h-5"></i>
          <span class="ms-3">Aktivitas Tambahan</span>
          <i class="fa-solid fa-chevron-down ms-auto"></i>
        </button>
        <ul x-show="open" class="space-y-2 ms-6">
          <li>
            <a href="{{ route('siswa.ekstrakurikuler.index') }}" class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-green-800 dark:hover:bg-green-800 group">
              <span class="ms-3">Ekstrakulikuler</span>
            </a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
  </div>
</aside>

