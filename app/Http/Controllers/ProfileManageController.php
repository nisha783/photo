<?php

namespace App\Http\Controllers;

use App\Models\profileManage;
use App\Models\Photo;
use App\Http\Requests\StoreprofileManageRequest;
use App\Http\Requests\UpdateprofileManageRequest;
use App\Models\dp;

class ProfileManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $photos=Photo::all();
        $dp=dp::all();
        $photos=Photo::all();
        return view('pf.index',compact('photos','dp','photos'));
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
    public function store(StoreprofileManageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(profileManage $profileManage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profileManage $profileManage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprofileManageRequest $request, profileManage $profileManage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profileManage $profileManage)
    {
        //
    }
}
