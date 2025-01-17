<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class JadwalController extends Controller
{
    public function indexJadwal(Request $request)
    {
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        $users = User::all();

        $kelasId = $request->input('id_kelas');
        $jadwals = Jadwal::filterByKelas($kelasId);

        return view('staff.jadwal.index', compact('kelas', 'mapels', 'users', 'jadwals'));
    }

    public static function filterByKelas($kelasId)
    {
        return Jadwal::query() // Mengganti self::query() dengan Jadwal::query()
            ->when($kelasId, function ($query, $kelasId) {
                return $query->where('kelas_id', $kelasId);
            })
            ->get();
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'hari' => 'required',
            'pukul' => 'required',
        ]);

        // Ambil id_user dari mapel
        $mapel = Mapel::findOrFail($request->id_mapel);
        $id_user = $mapel->id_user;

        Jadwal::create([
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_user' => $id_user,
            'hari' => $request->hari,
            'pukul' => $request->pukul,
        ]);

        return redirect()->route('staff.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'hari' => 'required',
            'pukul' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        // Ambil id_user dari mapel
        $mapel = Mapel::findOrFail($request->id_mapel);
        $id_user = $mapel->id_user;

        $jadwal->update([
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_user' => $id_user,
            'hari' => $request->hari,
            'pukul' => $request->pukul,
        ]);

        return redirect()->route('staff.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('staff.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function printJadwal($id_kelas)
    {
        try {
            $kelas = Kelas::findOrFail($id_kelas);
            $jadwals = Jadwal::where('id_kelas', $id_kelas)
                ->with(['mapel', 'mapel.user'])
                ->orderBy('hari')
                ->orderBy('pukul')
                ->get();

            $schedules = [
                'SENIN' => [], 'SELASA' => [], 'RABU' => [], 'KAMIS' => [], 'JUMAT' => []
            ];

            foreach ($jadwals as $jadwal) {
                $day = ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT'][$jadwal->hari - 1];
                $schedules[$day][] = [
                    'pukul' => $jadwal->pukul,
                    'mapel' => $jadwal->mapel->nama_mapel,
                    'guru' => $jadwal->mapel->user->name
                ];
            }

            $response = [
                'kelas' => $kelas->nama_kelas,
                'schedules' => $schedules
            ];

            Log::info('Respons Print Jadwal', $response);

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Kesalahan Print Jadwal', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
