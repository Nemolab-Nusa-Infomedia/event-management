<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
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
            'profile_pict' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Add validation for image
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => isset($user['name']) ? $request->role : 'user',
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_pict')) {
            // Delete old profile picture if exists
            if ($user->profile_pict) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
            }

            // Store the new image
            $image = $request->file('profile_pict');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('profile_pictures', $filename, 'public');

            $data['profile_pict'] = $filename;
        }

        if (isset($user['name'])) {
            $user->update($data);
        } else {
            User::where('id', Auth::user()->id)->update($data);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Add this method to handle profile picture deletion if needed
    public function deleteProfilePicture(User $user)
    {
        if ($user->profile_pict) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
            $user->update(['profile_pict' => null]);
        }

        return redirect()->back()->with('success', 'Profile picture removed successfully.');
    }

    public function destroy(User $user)
    {
        // Delete profile picture if exists
        if ($user->profile_pict) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_pict);
        }

        $user->delete();
        return redirect()->route('home.index')->with('danger', 'User deleted successfully.');
    }


    public function verifyEmail()
    {
        return view('auth.verify');
    }
}
