<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Added this line to import the Validator class
use Illuminate\Support\Facades\Hash; // Added this line to import the Hash facade

class GuruController extends Controller
{
    public function indexGuru()
    {
        $users = User::where('role', 2)->with('guru')->paginate(10);

        return view('staff.user.indexGuru', [
            'users' => $users,
        ]);
    }

    public function storeGuru(Request $request)
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

        // Assign Guru Role
        $guru = Guru::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->back()->with('success', 'Data guru baru berhasil ditambahkan.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data guru baru. Silakan coba lagi.');
    }
    }


    public function updateGuru(Request $request, $id)
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

            // Find the guru associated with the user and update their details
            $guru = $user->guru;
            if ($guru) {
                $guru->jenis_kelamin = $validatedData['jenis_kelamin'];
                $guru->agama = $validatedData['agama'];
                $guru->alamat = $validatedData['alamat'];
                $guru->no_telp = $validatedData['no_telp'];
                $guru->save();
            }

            return redirect()->back()->with('success', 'Guru updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data guru. Silakan coba lagi.');
        }
    }

    public function destroyGuru(User $user)
    {
        try {
            // Hapus guru terkait jika ada
            if ($user->guru) {
                $user->guru->delete();
            }

            // Hapus user
            $user->delete();

            return redirect()->route('staff.user.indexGuru')->with('success', 'Guru dan user deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data guru. Silakan coba lagi.');
        }
    }
}
