<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        $selectedKelas = $request->get('kelas');

        if ($selectedKelas) {
            $nilai = Nilai::whereHas('siswa', function ($query) use ($selectedKelas) {
                $query->where('id_kelas', $selectedKelas);
            })->get();
        } else {
            $nilai = Nilai::all();
        }

        return view('staff.nilai.index', compact('kelas', 'mapels', 'nilai'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        return view('staff.nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_mapel' => 'required',
            'nilai' => 'required|numeric',
        ]);

        Nilai::create([
            'id_siswa' => $request->id_siswa,
            'id_mapel' => $request->id_mapel,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('staff.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $nilai = Nilai::findOrFail($id);

        return view('staff.nilai.show', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());

        return redirect()->route('staff.nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('staff.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}