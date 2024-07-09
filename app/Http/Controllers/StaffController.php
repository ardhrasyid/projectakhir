<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function indexStaff()
    {
        $users = User::where('role', 1)->with('staff')->paginate(10);

        return view('staff.user.indexStaff', [
            'users' => $users,
        ]);
    }

    public function storeStaff(Request $request)
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

        // Assign Staff Role
        $staff = Staff::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->back()->with('success', 'Data staff baru berhasil ditambahkan.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data staff baru. Silakan coba lagi.');
    }
    }


    public function updateStaff(Request $request, $id)
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

            // Find the staff associated with the user and update their details
            $staff = $user->staff;
            if ($staff) {
                $staff->jenis_kelamin = $validatedData['jenis_kelamin'];
                $staff->agama = $validatedData['agama'];
                $staff->alamat = $validatedData['alamat'];
                $staff->no_telp = $validatedData['no_telp'];
                $staff->save();
            }

            return redirect()->back()->with('success', 'Staff updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data staff. Silakan coba lagi.');
        }
    }

    public function destroyStaff(User $user)
    {
        try {
            // Hapus staff terkait jika ada
            if ($user->staff) {
                $user->staff->delete();
            }

            // Hapus user
            $user->delete();

            return redirect()->route('staff.user.indexStaff')->with('success', 'Staff dan user deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data staff. Silakan coba lagi.');
        }
    }
}
