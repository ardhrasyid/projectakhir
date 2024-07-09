<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function indexPelanggaran()
    {
        $users = User::where('role', 3)->get();
    $pelanggaran = Pelanggaran::all();
    return view('staff.pelanggaran.index', compact('users', 'pelanggaran'));
}
    

public function storePelanggaran(Request $request)
{
    $request->validate([
        'nama_pelanggaran' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jenis' => 'required|string|max:255',
        'sanksi' => 'required|string|max:255',
        'user_id' => 'required|integer',
    ]);

    Pelanggaran::create($request->all());

    return redirect()->route('staff.pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan.');
}

    public function updatePelanggaran(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string|max:255',
            'sanksi' => 'required|string|max:255',
            'user_id' => 'required|integer',
          
        ]);

        $pelanggaran->update($request->all());

        return redirect()->route('staff.pelanggaran.index')->with('success', 'Pelanggaran berhasil diperbarui.');
    }

    public function destroyPelanggaran(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();

        return redirect()->route('staff.pelanggaran.index')->with('success', 'Pelanggaran berhasil dihapus.');
    }

    public function indexSiswa()
    {
        $users = User::where('role', 3)->get();
        $pelanggaran = Pelanggaran::where('user_id', Auth::id())->get();
        return view('siswa.pelanggaran.index', compact('pelanggaran', 'users'));
    }
}

