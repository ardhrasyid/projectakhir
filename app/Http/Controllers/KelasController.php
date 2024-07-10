<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\AnggotaKelas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{

    

    public function showAnggota($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $anggotaKelas = AnggotaKelas::where('kelas_id', $id_kelas)->get();
        $siswa = User::where('role', 3)->get();
        return view('staff.Kelas.anggota', compact('anggotaKelas', 'kelas', 'siswa'));
    }
    public function addAnggota(Request $request, $id_kelas)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        AnggotaKelas::create([
            'kelas_id' => $id_kelas,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('staff.kelas.showAnggota', $id_kelas)->with('success', 'Anggota kelas berhasil ditambahkan.');
    }

    public function destroyAnggota($id_kelas, $id_anggota)
    {
        $anggota = AnggotaKelas::findOrFail($id_anggota);
        $anggota->delete();

        return redirect()->route('staff.kelas.showAnggota', $id_kelas)->with('success', 'Anggota kelas berhasil dihapus.');
    }

    public function indexKelas()
    {
        $users = User::where('role', 2)->get();
        $siswa = User::where('role', 3)->get();
        $kelas = Kelas::all();
        return view('staff.kelas.index', compact('users', 'kelas', 'siswa'));
    }
    
    public function storeKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('staff.kelas.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function updateKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('staff.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroyKelas(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('staff.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function indexGuru($id_kelas)
    {
    
    }


    // public function indexGuru()
    // {
    //     $user = Auth::user();
    //     $users = User::where('role', 2)->get();
    //     $students = User::where('role', 3)->get();
    //     $kelas = Kelas::where('user_id', $user->id)->with('user')->paginate(10);
    
    //     return view('guru.kelas.index', [
    //         'kelas' => $kelas,
    //         'users' => $users,
    //         'students' => $students,
    //     ]);
    // }
    
    // public function show($id_kelas)
    // {
    //     $kelas = Kelas::findOrFail($id_kelas);
    //     $anggotaKelas = AnggotaKelas::where('kelas_id', $id_kelas)->get();
    //     $siswa = User::where('role', 3)->get();
    //     return view('guru.kelas.index', compact('anggotaKelas', 'kelas', 'siswa'));
    // }


}
