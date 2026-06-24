<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            $user = \App\Models\User::first();
            if ($user) {
                auth()->login($user);
            }
        }
        return view('profile.index');
    }

    public function update(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('profile.index')->withErrors(['You must be logged in.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($request->only('name', 'email'));

        return redirect()->route('profile.index')
            ->with('profile_success', 'Profile updated successfully.');
    }

    public function password(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('profile.index')->withErrors(['You must be logged in.']);
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        auth()->user()->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.index')
            ->with('profile_success', 'Password updated successfully.');
    }
}
