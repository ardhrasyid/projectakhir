<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Added this line to import the Validator class
use Illuminate\Support\Facades\Hash; // Added this line to import the Hash facade

class SiswaController extends Controller
{
    public function indexSiswa(Request $request)
    {
        // $users = User::where('role', 3)->with('siswa')->paginate(10);
        
        $sort = $request->get('sort', 'name');
        $order = $request->get('order', 'asc');
        $search = $request->input('search');
        
        $users = User::where('role', 3)->with('siswa')
            ->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('username', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%")
                      ->orWhereHas('siswa', function($query) use ($search) {
                          $query->where('no_telp', 'LIKE', "%{$search}%");
                      });
            })
            ->orderBy($sort, $order)
            ->paginate(10);
        
        return view('staff.user.indexSiswa', [
            'users' => $users,
            'search' => $search, // Tambahkan ini untuk mengirimkan nilai pencarian ke view
        ]);
    }

        
    
        public function storeSiswa(Request $request)
        {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'jenis_kelamin' => 'nullable|string|max:10',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'role' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            // Create User
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
    
            // Assign Siswa Role
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
    
            return redirect()->back()->with('success', 'Data siswa baru berhasil ditambahkan.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data siswa baru. Silakan coba lagi.');
        }
        }
    
    
        public function updateSiswa(Request $request, $id)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'jenis_kelamin' => 'nullable|string',
                'agama' => 'nullable|integer',
                'alamat' => 'nullable|string|max:255',
                'no_telp' => 'nullable|string|max:15',
            ]);
    
            try {
                // Find the user and update their details
                $user = User::findOrFail($id);
                $user->name = $validatedData['name'];
                $user->username = $validatedData['username'];
                $user->email = $validatedData['email'];
                $user->save();
    
                // Find the siswa associated with the user and update their details
                $siswa = $user->siswa;
                if ($siswa) {
                    $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
                    $siswa->agama = $validatedData['agama'];
                    $siswa->alamat = $validatedData['alamat'];
                    $siswa->no_telp = $validatedData['no_telp'];
                    $siswa->save();
                }
    
                return redirect()->back()->with('success', 'Siswa updated successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data siswa. Silakan coba lagi.');
            }
        }
    
        public function destroySiswa(User $user)
        {
            try {
                // Hapus siswa terkait jika ada
                if ($user->siswa) {
                    $user->siswa->delete();
                }
    
                // Hapus user
                $user->delete();
    
                return redirect()->route('staff.user.indexSiswa')->with('success', 'Siswa dan user deleted successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa. Silakan coba lagi.');
            }
        }
    }
