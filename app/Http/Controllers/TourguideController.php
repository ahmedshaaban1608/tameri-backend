<?php

namespace App\Http\Controllers;

use App\Models\Tourguide;
use Illuminate\Http\Request;

class TourguideController extends Controller
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
    // public function show(Tourguide $tourguide)
    // {
    //     //
    // }
    public function show($id)
    {
        // $tourguides = Tourguide::all();
        // return view('Dashboard.tourguides', ['tourguides' => $tourguides]);

        $tourguide = Tourguide::find($id);
        return view('Dashboard.tourguide.showTourguide', ['tourguide' => $tourguide]);
    }
   
    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Tourguide $tourguide)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Tourguide $tourguide)
    // {
    //     //
    // }
    public function edit($id)
    {
           $tourguide = Tourguide::find($id);
        return view('Dashboard.tourguide.editTourguide', ['tourguide' => $tourguide]);
    }

    public function update(Request $request, $id)
    {
        $tourguide = Tourguide::find($id);
    
        if ($tourguide) {
            $tourguide->update([
                'description' => $request->input('description'),
                'bio' => $request->input('bio'),
            ]);
    
            return redirect()->route('tourguides')->with('success', 'tourguide updated successfully.');
        } else {
            return redirect()->back()->with('error', 'tourguide not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        //
    }
}
