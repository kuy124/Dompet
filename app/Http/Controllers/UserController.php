<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();

        $searchTerm = $request->get('search');
        $users = User::query();

        $authUser = auth()->user();

        if ($authUser->role_id == 2) {
            $users = $users->where('role_id', 3);
        }

        if ($searchTerm) {
            $users = $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('id', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $users->get();

        $user = null;
        if ($request->has('edit')) {
            $user = User::find($request->input('edit'));
        }

        return view('user', compact('users', 'roles', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('Berhasil', 'Berhasil membuat user.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->only('name', 'email', 'role_id');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user')->with('Berhasil', 'Berhasil mengupdate user.');
    }

    public function edit($id)
    {
        $authUser = auth()->user();

        $user = User::findOrFail($id);

        $roles = Role::all();

        if ($authUser->role_id == 2) {
            $users = User::where('role_id', 3)->get();
        } else {
            $users = User::all();
        }

        return view('user', compact('user', 'roles', 'users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('Berhasil', 'Berhasil menghapus user.');
    }
}
