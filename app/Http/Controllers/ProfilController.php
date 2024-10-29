<?php

namespace App\Http\Controllers;

use App\Models\dp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfilController extends Controller
{
    //
    public function edit()
    {
        $dp=dp::all();
        return view('profil.edit',compact('dp'), ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
    
        // Step 2: Retrieve the authenticated user
        $user = Auth::user();
    
       
        // Step 4: Update other user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
    
        // Step 5: Redirect with success message
        return redirect()->route('profil.edit')->with('success', 'Profile updated successfully.');
    }
}
