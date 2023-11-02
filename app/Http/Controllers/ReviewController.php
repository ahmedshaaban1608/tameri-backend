<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        //
        try {
            $review = ReviewResource::collection(Review::all());

            return response()->json(['data' => $review], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
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
    public function store(StoreAreaRequest $request)
    {
        
            try {
                if (Gate::allows('is-admin')) {
                    $review = Review::create($request->all());
                    return response()->json(["message" => "Review created successfully", 'data' => new ReviewResource($review)], 200);
                } else {
                    return response()->json(['message' => 'Only tourists are allowed to create reviews.'], 403);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while creating the review'], 500);
            }
        
    }


  public function show(Review $review)
{
    $reviews = Review::all();
    return view('Dashboard.reviews', ['reviews' => $reviews]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Review $review)
    {
       
            try {
                if (Gate::allows('is-admin')) {
                    $review->update($request->all());
                    return response()->json(["message" => "Review updated successfully", 'data' => new ReviewResource($review)], 200);
                } else {
                    return response()->json(['message' => 'only the admin is Allowed to make updates.'], 403);
                }

            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while updating the review'], 500);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
        {

            try {
                if (Gate::allows('is-admin')) {

                        $review->delete();
                        return response()->json("deleted successfully", 200);
                    } else {
                        return response()->json(['message' => 'only the Owner Of The Review is Allowed to Delete.'], 403);
                    }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while deleting the review'], 500);
            }
        }
    }
}
