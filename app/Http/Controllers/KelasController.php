<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{

    public function showKelas($id)
    {
        $kelas = Kelas::find($id);
        
        if (!$kelas) {
            return redirect()->route('staff.kelas.index')->with('error', 'Kelas tidak ditemukan.');
        }

        return view('staff.kelas.show', compact('kelas'));
    }

    public function indexKelas()
    {
        $users = User::where('role', 2)->get();
        $students = User::where('role', 3)->get();
        $kelas = Kelas::all();
        return view('staff.kelas.index', compact('users', 'kelas', 'students'));
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

    public function addMember(Request $request, Kelas $kelas)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::where('id', $request->user_id)->where('role', 3)->first();

        if (!$user) {
            return redirect()->route('staff.kelas.index')->with('error', 'User tidak ditemukan atau bukan siswa.');
        }

        $kelas->users()->attach($user->id);

        return redirect()->route('staff.kelas.index')->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }

public function indexGuru()
{
    $user = Auth::user();
    $users = User::where('role', 2)->get();
    $students = User::where('role', 3)->get();
    $kelas = Kelas::where('user_id', $user->id)->with('user')->paginate(10);

    return view('guru.kelas.index', [
        'kelas' => $kelas,
        'users' => $users,
        'students' => $students,
    ]);
}
}
