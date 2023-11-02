<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
        {
            $validator = Validator::make($request->all(), [
                // 'tourist_id' => 'required|numeric',
                'tourguide_id' => 'required|numeric',
                'title' => 'required|string',
                'comment' => 'required|string',
                'stars' => 'required|in:1,2,3,4,5',
            ]);
            if ($validator->fails()) {
                return response($validator->errors()->all(), 422);
            }
            try {
                if (Gate::allows('is-tourist')) {
                    $user = auth()->user();
                    $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    // $tourist = Tourist::findOrFail($request->tourist_id);
                    $request->merge(['tourist_id' => $user->id]);
                    $review = Review::create($request->all());
                    return response()->json(["message" => "Review created successfully", 'data' => new ReviewResource($review)], 200);
                } else {
                    return response()->json(['message' => 'Only tourists are allowed to create reviews.'], 403);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while creating the review'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Review $review)
    // {
    //     //
    // }
  public function show()
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
        //
        {
            $validator = Validator::make($request->all(), [
                // 'tourist_id' => 'required|numeric',
                'tourguide_id' => 'required|numeric',
                'title' => 'required',
                'comment' => 'required|string',
                'stars' => "required|in:1,2, 3, 4, 5",
                'status' => "required|in:pending,confirmed,declined"
            ]);
            if ($validator->fails()) {
                return response($validator->errors()->all(), 422);
            }
            try {
                if (Gate::allows('is-admin')) {
                    $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    // $tourist = Tourist::findOrFail($request->tourist_id);
                    $review->update($request->all());
                    return response()->json(["message" => "Review updated successfully", 'data' => new ReviewResource($review)], 200);
                } else {
                    return response()->json(['message' => 'only the admin is Allowed to make updates.'], 403);
                }

            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while updating the review'], 500);
            }

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
                if (Gate::allows('is-tourist')) {
                    $user = auth()->user();
                    if ($review->tourist_id === $user->id) {
                        $review->delete();
                        return response()->json("deleted successfully", 200);
                    } else {
                        return response()->json(['message' => 'only the Owner Of The Review is Allowed to Delete.'], 403);
                    }
                } else {
                    return response()->json(['message' => 'only the Owner Of The Review is Allowed to Delete.'], 403);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while deleting the review'], 500);
            }
        }
    }
}
