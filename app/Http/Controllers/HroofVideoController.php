<?php

namespace App\Http\Controllers;

use App\Models\HroofVideo;
use Illuminate\Http\Request;

class HroofVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $store = new HroofVideo();
        $store->id = $request->id;
        $store->youtube_link = $request->youtube_link;
        $store->Hroofs_name= $request->Hroofs_name;
        $store->save();

    }
    public function show(HroofVideo $hroofVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HroofVideo $hroofVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HroofVideo $hroofVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HroofVideo $hroofVideo)
    {
        //
    }


    public function test(){
        return view('test');
    }
}
