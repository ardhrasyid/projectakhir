<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\anggotakelas;
use App\Models\Kelas;

class AbsenController extends Controller
{
    public function indexAbsen(Request $request)
{
    $kelas = Kelas::all();
    $kelasId = $request->input('kelas_id');
    
    // Gunakan scope filterByKelas dari model Absen
    $absensi = Absen::filterByKelas($kelasId)->get();

    return view('staff.absen.index', compact('absensi', 'kelas'));
    }
    
    public function createAbsen()
    {
        return view('guru.absen.create');
    }

    public function storeAbsen(Request $request)
    {
        $request->validate([
            'nama_absen' => 'required',
        ]);

        Absen::create($request->all());

        return redirect()->route('guru.absen.index')->with('success', 'Absen created successfully.');
    }

    // Method untuk memperbarui status absensi
    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|integer|in:1,2,3',
        ]);

        // Temukan absensi berdasarkan ID
        $absen = Absen::findOrFail($id);

        // Perbarui status absensi
        $absen->status = $request->input('status');
        $absen->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('staff.absen.index')->with('success', 'Status absensi berhasil diperbarui.');
    }

    // Method untuk menghapus absensi
    // public function destroy($id)
    // {
    //     // Temukan absensi berdasarkan ID
    //     $absen = Absen::findOrFail($id);

    //     // Hapus absensi
    //     $absen->delete();

    //     // Redirect kembali dengan pesan sukses
    //     return redirect()->route('staff.absen.index')->with('success', 'Absensi berhasil dihapus.');
    // }

    public function updateAbsen(Request $request, Absen $absen)
    {
        $request->validate([
            'nama_absen' => 'required',
        ]);

        $absen->update($request->all());

        return redirect()->route('guru.absen.index')->with('success', 'Absen updated successfully.');
    }

    public function destroyAbsen(Absen $absen)
    {
        $absen->delete();

        return redirect()->route('guru.absen.index')->with('success', 'Absen deleted successfully.');
    }

    public function indexAbsenGuru()
    {
        $absen = Absen::all();
        return view('guru.absen.index', compact('absen'));
    }
}
