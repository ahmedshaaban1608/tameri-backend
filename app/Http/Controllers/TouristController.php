<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;

class TouristController extends Controller
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
   
    public function show($id)
    {
        // $tourists = Tourist::all();
        // return view('Dashboard.tourists', ['tourists' => $tourists]);
        $tourist = Tourist::find($id);
        return view('Dashboard.tourist.showTourist', ['tourist' => $tourist]);
    }
 

    /**
     * Show the form for editing the specified resource.
     */
   
     public function edit($id)
    {
           $tourist = Tourist::find($id);
        return view('Dashboard.tourist.editTourist', ['tourist' => $tourist]);
    }

    public function update(Request $request, $id)
    {
        $tourist = Tourist::find($id);
    
        if ($tourist) {
            $tourist->update([
                'country' => $request->input('country'),
                'gender' => $request->input('gender'),
                'avatar' => $request->input('avatar'),
                'phone' => $request->input('phone'),
            ]);
    
            return redirect()->route('tourists')->with('success', 'Tourist updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Tourist not found.');
        }
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */

 
   
public function destroy($id)
{
    $tourist = Tourist::find($id);
    
    if ($tourist) {
        $tourist->delete();
        return redirect()->back()->with('success', 'Tourist data deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'Tourist data not found.');
    }
}
// public function destroy(Tourist $tourist)
// {
//     $tourist->delete();
//     return redirect()->back()->with('success', 'Tourist data deleted successfully.');
// }

}
