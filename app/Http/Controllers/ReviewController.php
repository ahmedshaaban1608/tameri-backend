<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
    // public function show(Review $review)
    // {
    //     //
    // }
  public function show($id)
{
    // $reviews = Review::all();
    // return view('Dashboard.reviews', ['reviews' => $reviews]);
    $review = Review::find($id);
    return view('Dashboard.review.showReview', ['review' => $review]);
}


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Review $review)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Review $review)
    // {
    //     //
    // }
    public function edit($id)
    {
           $review = Review::find($id);
        return view('Dashboard.review.editReview', ['review' => $review]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
    
        if ($review) {
            $review->update([
                'title' => $request->input('title'),
                'comment' => $request->input('comment'),
                // 'avatar' => $request->input('avatar'),
                // 'phone' => $request->input('phone'),
            ]);
    
            return redirect()->route('reviews')->with('success', 'reviews updated successfully.');
        } else {
            return redirect()->back()->with('error', 'reviews not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
