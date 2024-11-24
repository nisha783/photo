<?php

namespace App\Http\Controllers;

use App\Models\dp;
use App\Http\Requests\StoredpRequest;
use App\Http\Requests\UpdatedpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dp = dp::all();
        return view('dp.index', compact('dp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredpRequest $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Save the file path to the currently authenticated user's profile
            $dp =Auth::user();
            $dp->filepath = $filePath;
            $dp->save();
        
            return redirect()->route('photo.index')->with('success', 'Profile picture updated successfully.');
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(dp $dp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dp $dp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedpRequest $request, dp $dp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dp $dp, $id)
    {
        //
        $dp->delete();

        return redirect()->route('photo.index')->with('success', 'deleted successfully.');
    }
}
