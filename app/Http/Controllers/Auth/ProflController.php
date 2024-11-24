<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\dp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProflController extends Controller
{
    //namespace App\Http\Controllers\Auth;



public function showUploadForm()
{
//return view('auth.profile-upload'); // A separate view to upload the profile picture
}

/**
* Handle the profile picture upload.
*/
public function uploadProfilePicture(Request $request)
{
// Validate the uploaded image
$request->validate([
'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the profile picture
]);

// Handle the uploaded file
if ($request->hasFile('profile_picture')) {
$profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

// Check if the user already has a profile picture (check dp table)
$user = Auth::user();
$existingProfile = dp::where('user_id', $user->id)->first();

// If the user already has a profile picture, update it
if ($existingProfile) {
$existingProfile->update(['filepath' => $profilePicturePath]);
} else {
// If no profile picture exists, create a new entry
Dp::create([
'user_id' => $user->id,
'filepath' => $profilePicturePath,
]);
}

return redirect()->route('photo.index')->with('success', 'Profile picture updated successfully.');
}

return back()->withErrors(['profile_picture' => 'Please upload a valid image.']);
}

}
