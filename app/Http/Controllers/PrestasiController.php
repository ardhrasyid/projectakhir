<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\User;

class PrestasiController extends Controller
{
    
    public function indexPrestasi()
    {
        $prestasi = Prestasi::all();
        $users = User::all();
        return view('staff.prestasi.index', compact('prestasi', 'users'));
    }
    

    public function storePrestasi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'status' => 'nullable|string|max:255',
            'bukti' => 'required|file|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        $buktiPath = $request->file('bukti')->store('bukti_prestasi', 'public');

        // Simpan data ke database
        Prestasi::create([
            'user_id' => auth()->id(),
            'nama_prestasi' => $request->nama_prestasi,
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('staff.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function updatePrestasi(Request $request, Prestasi $prestasi)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'bukti' => 'nullable|file|mimes:pdf|max:2048', // Validasi file PDF
        ]);

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_prestasi', 'public');
            $prestasi->bukti = $buktiPath;
        }

        $prestasi->update([
            'user_id' => $request->user_id,
            'nama_prestasi' => $request->nama_prestasi,
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'bukti' => $prestasi->bukti,
        ]);

        return redirect()->route('staff.prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function validatePrestasi(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|in:1,2', // Ensure the status is either 1 or 2
        ]);
    
        // Find the Prestasi by its ID
        $prestasi = Prestasi::find($id);
        if ($prestasi) {
            // Update the status
            $prestasi->status = $request->input('status');
            $prestasi->save();
    
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Status updated successfully!');
        }
    
        // Redirect back with an error message if the Prestasi is not found
        return redirect()->back()->with('error', 'Prestasi not found.');
    }
    
    
    
    public function destroyPrestasi(Prestasi $prestasi)
    {
        $prestasi->delete();

        return redirect()->route('staff.prestasi.index')->with('success', 'Prestasi deleted successfully.');
    }

    public function showBukti($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $buktiPath = storage_path('app/public/' . $prestasi->bukti);

        if (file_exists($buktiPath)) {
            return response()->file($buktiPath);
        } else {
            return redirect()->route('staff.prestasi.index')->with('error', 'Bukti tidak ditemukan.');
        }
    }

    public function viewPDF($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $buktiPath = storage_path('app/public/' . $prestasi->bukti);

        if (file_exists($buktiPath)) {
            $content = file_get_contents($buktiPath);
            return response($content)->header('Content-Type', 'application/pdf');
        } else {
            return redirect()->route('staff.prestasi.index')->with('error', 'Bukti tidak ditemukan.');
        }
    }


    public function indexSiswa()
    {
        $prestasi = Prestasi::all();
        return view('siswa.prestasi.index', compact('prestasi'));
    }   
}
