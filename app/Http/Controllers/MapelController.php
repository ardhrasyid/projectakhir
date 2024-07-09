<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\User;

class MapelController extends Controller
{
    public function indexMapel()
    {
        $users = User::where('role', 2)->get();
        $mapel = Mapel::all();
        return view('staff.mapel.index', compact('mapel', 'users'));
    }

    public function storeMapel(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('staff.mapel.index')->with('success', 'Mapel berhasil dibuat.');
    }

    public function updateMapel(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('staff.mapel.index')->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroyMapel(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->route('staff.mapel.index')->with('success', 'Mapel deleted successfully.');
    }
}
