<?php

namespace App\Http\Controllers;

use App\Models\dp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PasswordController extends Controller
{
    //
    public function edit()
    {
        $dp=dp::all();
        return view('password.edit',compact('dp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.edit')->with('success', 'Password updated successfully.');
    }
}
