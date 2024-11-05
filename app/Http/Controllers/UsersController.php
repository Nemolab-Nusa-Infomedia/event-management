<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Tampilkan semua pengguna
    public function index()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    // Form untuk membuat pengguna baru
    public function create()
    {
        return view('users.create');
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Tampilkan detail pengguna
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Form untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Perbarui data pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Hapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
