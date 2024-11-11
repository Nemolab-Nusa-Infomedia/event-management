<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

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
        return view('auth.register');
        // return view('home.create');
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email_verification_expired_at' => now()->addMinutes(30),
            'password' => bcrypt($validatedData['password']),
        ]);

        // Trigger event untuk mengirim email verifikasi
        event(new Registered($user));

        // Redirect ke halaman verifikasi
        return redirect()->route('verification.notice');

        // return redirect()->route('home.index')->with('success', 'User created successfully.');
    }

    // Tampilkan detail pengguna
    public function show(User $user)
    {
        return response()->json($user);
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

        if (isset($user['name'])) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role,
            ]);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => 'user',
            ];

            User::where('id', Auth::user()->id)->update($data);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Hapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home.index')->with('success', 'User deleted successfully.');
    }

    public function verifyEmail()
    {
        return view('auth.verify');
    }
}
