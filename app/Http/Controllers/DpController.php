<?php

namespace App\Http\Controllers;

use App\Models\dp;
use App\Http\Requests\StoredpRequest;
use App\Http\Requests\UpdatedpRequest;
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
        $dp=dp::all();
        return view('dp.index',compact('dp'));
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
    $validator = Validator::make($request->all(), [
        'dp' => 'required|image',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    // Step 2: Handle the file upload
    $dp = Dp::first(); 
    
    if ($dp && $dp->filepath) {
        Storage::disk('public')->delete($dp->filepath);
    }
    
    if ($request->hasFile('dp')) {
        $filepath = $request->file('dp')->store('photos', 'public');
        
        $userId = auth()->id(); // Make sure user is authenticated
    
        if ($dp) {
            $dp->filepath = $filepath;
            $dp->user_id = $userId; // Update user_id
            $dp->save();
        } else {
            // Create a new record if none exists
            $dp = new Dp();
            $dp->filepath = $filepath;
            $dp->user_id = $userId; // Set user_id for the new record
            $dp->save();
        }
    }
    
    return redirect()->route('photo.index')->with('success', 'Photo created successfully.');
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
    public function destroy(dp $dp)
    {
        //
    }
}
