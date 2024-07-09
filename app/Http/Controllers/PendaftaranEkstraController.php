<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranEkstra;

class PendaftaranEkstraController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'id_ekskul' => 'required',
            'id_user' => 'required',
            'tanggal_daftar' => 'required|date',
            'status_penerimaan' => 'required|in:0,1,2', // Status penerimaan harus berupa 0, 1, atau 2
        ]);
    
        // Membuat data pendaftaran ekstra baru dengan data dari request
        PendaftaranEkstra::create([
            'id_ekskul' => $request->id_ekskul,
            'id_user' => $request->id_user,
            'tanggal_daftar' => $request->tanggal_daftar,
            'status_penerimaan' => $request->status_penerimaan,
        ]);
    
        // Redirect ke halaman index siswa dengan pesan sukses
        return redirect()->route('siswa.ekstrakurikuler.index')->with('success', 'Pendaftaran Ekstrakurikuler berhasil dibuat.');
    }
}
