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
        $validator = Validator::make($request->all(), [
            'dp' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('dp')) {
            $dp = Dp::where('user_id', auth()->id())->first();

            if ($dp && $dp->filepath) {
                Storage::disk('public')->delete($dp->filepath);
            }

            $filepath = $request->file('dp')->store('photos', 'public');

            if ($dp) {
                $dp->filepath = $filepath;
                $dp->save();
            } else {
                $dp = new Dp();
                $dp->filepath = $filepath;
                $dp->user_id = auth()->id();
                $dp->save();
            }
        }

        return redirect()->route('photo.index')->with('success', 'Profile picture updated successfully.');
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
