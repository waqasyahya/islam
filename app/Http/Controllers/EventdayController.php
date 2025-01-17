<?php

namespace App\Http\Controllers;

use App\Models\Eventday;
use Illuminate\Http\Request;

class EventdayController extends Controller
{
    public function showEvents()
    {
        $currentDateTime = now();

        $events = Eventday::where('start_time', '<=', $currentDateTime)
                        ->where('end_time', '>=', $currentDateTime)
                        ->get();

        return view('welcome', compact('events'));
    }
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Eventday $eventday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eventday $eventday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eventday $eventday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eventday $eventday)
    {
        //
    }
}
