<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $subRoles = SubRole::all();
        $users = User::paginate(10);
        return view('staff.user.index', compact('users', 'subRoles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|integer',
            'sub_roles' => 'array',
            'sub_roles.*' => 'integer',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Attach sub_roles to the user
    if ($request->has('sub_roles')) {
        $user->subRoles()->attach($request->sub_roles);
    }

        return redirect()->route('staff.user.index')->with('success', 'User created successfully');
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => 'required|integer',
            'sub_roles' => 'nullable|array',
            'sub_roles.*' => 'integer',
        ]);

        $user->update([
            'role' => $validatedData['role'],
        ]);

        if (isset($validatedData['sub_roles'])) {
            $user->subRoles()->sync($validatedData['sub_roles']);
        }

        return redirect()->route('staff.user.index')->with('success', 'User updated successfully');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('staff.user.index')->with('success', 'User deleted successfully');
    }
}