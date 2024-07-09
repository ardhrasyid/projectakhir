<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;

class AbsenController extends Controller
{
    public function indexAbsen()
    {
        $absen = Absen::all();
        return view('guru.absen.index', compact('absen'));
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
