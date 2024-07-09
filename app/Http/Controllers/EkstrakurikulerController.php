<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Added this line to import the Auth class
use App\Models\PendaftaranEkstra;
use Carbon\Carbon; // Tambahkan ini untuk menggunakan Carbon

class EkstrakurikulerController extends Controller
{
    //Staff
    public function indexStaff()
    {
        $users = User::where('role', 2)->get();

        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('staff.ekstrakurikuler.index', compact('ekstrakurikuler', 'users'));
    }

    public function storeStaff(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'nama' => 'required', // Nama ekstrakurikuler harus diisi
            'user_id' => 'required|exists:users,id',
            'deskripsi' => 'nullable', // Deskripsi ekstrakurikuler boleh kosong
            'status' => 'nullable', // Status ekstrakurikuler boleh kosong
            'kuota' => 'nullable|integer', // Kuota ekstrakurikuler boleh kosong dan harus berupa angka
            'status_pendaftaran' => 'nullable', // Status pendaftaran boleh kosong
            'tgl_dibuka' => 'nullable|date', // Tanggal pendaftaran boleh kosong dan harus berupa tanggal
            'tgl_ditutup' => 'nullable|date', // Tanggal pendaftaran boleh kosong dan harus berupa tanggal
        ]);

        // Membuat data ekstrakurikuler baru dengan data dari request
        Ekstrakurikuler::create([
            'nama' => $request->nama,
            'user_id' => $request->user_id,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'kuota' => $request->kuota,
            'status_pendaftaran' => $request->status_pendaftaran,
            'tgl_dibuka' => $request->tgl_dibuka,
            'tgl_ditutup' => $request->tgl_ditutup,
        ]);

        // Redirect ke halaman index staff ekstrakurikuler dengan pesan sukses
        return redirect()->route('staff.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dibuat.');
    }


    public function updateStatus(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'status' => 'required|in:0,1', // Pastikan status adalah 0 atau 1
        ]);

        // Temukan Ekstrakurikuler berdasarkan ID
        $ekstra = Ekstrakurikuler::findOrFail($id);
        // Update status
        $ekstra->status = $request->input('status');
        $ekstra->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('staff.ekstrakurikuler.index')->with('success', 'Status updated successfully');
    }

    public function updateStaff(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'status' => 'nullable',
            'kuota' => 'nullable|integer',
            'status_pendaftaran' => 'nullable',
            'tgl_dibuka' => 'nullable|date',
            'tgl_ditutup' => 'nullable|date',
        ]);

        $ekstrakurikuler->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'kuota' => $request->kuota,
            'status_pendaftaran' => $request->status_pendaftaran,
            'tgl_dibuka' => $request->tgl_dibuka,
            'tgl_ditutup' => $request->tgl_ditutup,
        ]);

        return redirect()->route('staff.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroyStaff($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $ekstrakurikuler->delete();

        return redirect()->route('staff.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus');
    }

    public function indexGuru()
    {
        // Ambil user yang sedang login
        
        $user = Auth::user();

        // Ambil data ekstrakurikuler yang sesuai dengan user_id pengguna yang sedang login
        $ekstrakurikuler = Ekstrakurikuler::where('user_id', $user->id)->get();

        // Filter data ekstrakurikuler yang statusnya 1
        $ekstrakurikuler = $ekstrakurikuler->filter(function ($ekstra) {
            return $ekstra->status == 1;
        });

        // Ambil semua data pendaftaran ekstra
        $pendaftaranEkstra = PendaftaranEkstra::all();

        // Ambil semua pengguna dengan role guru (2)
        $usersGuru = User::where('role', 2)->get();

        // Ambil semua pengguna dengan role tertentu (misalnya role 3)
        $usersSiswa = User::where('role', 3)->get();

        return view('guru.ekstrakurikuler.index', compact('ekstrakurikuler', 'pendaftaranEkstra', 'usersGuru', 'usersSiswa'));
    }



    public function updateGuru(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'status' => 'nullable',
            'kuota' => 'nullable|integer',
            'status_pendaftaran' => 'nullable',
            'tgl_dibuka' => 'nullable|date_format:Y-m-d',
            'tgl_ditutup' => 'nullable|date_format:Y-m-d',
        ]);

        $ekstrakurikuler->nama = $request->nama;
        $ekstrakurikuler->deskripsi = $request->deskripsi;
        $ekstrakurikuler->status = $request->status;
        $ekstrakurikuler->kuota = $request->kuota;
        $ekstrakurikuler->status_pendaftaran = $request->status_pendaftaran;
        $ekstrakurikuler->tgl_dibuka = $request->tgl_dibuka;
        $ekstrakurikuler->tgl_ditutup = $request->tgl_ditutup;
        $ekstrakurikuler->save();

        return redirect()->route('guru.ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }
    public function updateStatusP(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'status_pendaftaran' => 'required|in:0,1', // Pastikan status adalah 0 atau 1
        ]);

        // Temukan Ekstrakurikuler berdasarkan ID
        $ekstra = Ekstrakurikuler::findOrFail($id);
        // Update status
        $ekstra->status = $request->input('status_pendaftaran');
        $ekstra->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('guru.ekstrakurikuler.index')->with('success', 'Status updated successfully');
    }

    public function updateStatusTerima(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'status_penerimaan' => 'required|in:0,1,2', // Pastikan status_penerimaan adalah 0, 1, atau 2
        ]);

        // Temukan PendaftaranEkstra berdasarkan ID
        $ekstra = PendaftaranEkstra::findOrFail($id);
        // Update status_penerimaan
        $ekstra->status_penerimaan = $request->input('status_penerimaan'); // Pastikan kolom yang benar diupdate
        $ekstra->save();

        return redirect()->route('guru.ekstrakurikuler.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function indexSiswa()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        // Ambil semua data ekstrakurikuler
        $ekstrakurikuler = Ekstrakurikuler::all();

        $ekstrakurikuler = $ekstrakurikuler->filter(function ($ekstra) {
            return $ekstra->status == 1;
        });
        // Ambil semua data pendaftaran ekstra
        $pendaftaranEkstra = PendaftaranEkstra::all();

        // Ambil semua pengguna dengan role guru (2)
        $usersGuru = User::where('role', 2)->get();

        // Ambil semua pengguna dengan role tertentu (misalnya role 3)
        $usersSiswa = User::where('role', 3)->get();

        // Ambil ID ekstrakurikuler pertama sebagai contoh
        $ekstrakurikuler_id = $ekstrakurikuler->first()->id ?? null;

        // Cek pendaftaran siswa
        $cekPendaftaran = $this->cekPendaftaranSiswa($ekstrakurikuler_id);

        return view('siswa.ekstrakurikuler.index', compact('pendaftaranEkstra', 'usersGuru', 'usersSiswa', 'ekstrakurikuler', 'cekPendaftaran'));
    }




    public function cekPendaftaranSiswa($ekstrakurikuler_id)
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        // Cek apakah siswa dengan userId sudah pernah mendaftar ekstrakurikuler
        return PendaftaranEkstra::where('id_ekskul', $ekstrakurikuler_id)
                                ->where('id_user', $user->id)
                                ->first();
    }

    public function cekKuotaPenuh($ekstraId)
    {
        $ekstrakurikuler = Ekstrakurikuler::find($ekstraId);
        $jumlahPendaftar = PendaftaranEkstra::where('id_ekskul', $ekstraId)->count();

        return $jumlahPendaftar >= $ekstrakurikuler->kuota;
    }
}
