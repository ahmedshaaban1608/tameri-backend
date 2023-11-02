<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    public function index()
    {
        try {
            $review = ReviewResource::collection(Review::all());
            return response()->json(['data' => $review], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(Request $request)
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
            $user = auth()->user();
            if ($user->type === 'tourist') {
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

    public function show(Review $review)
    {
        try {
            return response()->json(new ReviewResource($review), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }
    //if the review will update by the only tourist who made it
    // public function update(Request $request, Review $review)
    // {
    //     $validator = Validator::make($request->all(), [
    //         // 'tourist_id' => 'required|numeric',
    //         'tourguide_id' => 'required|numeric',
    //         'title' => 'required',
    //         'comment' => 'required|string',
    //         'stars' => "required|in:1,2, 3, 4, 5",
    //         'status' => "required|in:pending,confirmed,declined"
    //     ]);
    //     if ($validator->fails()) {
    //         return response($validator->errors()->all(), 422);
    //     }
    //     try {
    //         $user = auth()->user();
    //         if ($user->type === 'tourist') {
    //             if ($user->id === $review->tourist_id) {
    //                 $tourguide = Tourguide::findOrFail($request->tourguide_id);
    //                 // $tourist = Tourist::findOrFail($request->tourist_id);
    //                 $request->merge(['tourist_id' => $user->id]);

    //                 $review->update($request->all());
    //                 return response()->json(["message" => "Review updated successfully", 'data' => new ReviewResource($review)], 200);
    //             } else {
    //                 return response()->json(['message' => 'only the Owner Of The Review is Allowed to make updates.'], 403);
    //             }
    //         } else {
    //             return response()->json(['message' => 'Only tourists are allowed to update reviews.'], 403);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'An error occurred while updating the review'], 500);
    //     }
    // }

    //no one can update the review
    public function update(Request $request, Review $review)
    {
        return response()->json(['message' => 'Review updates are not allowed.'], 403);
    }


    public function destroy(Review $review)
    {
        try {
            $user = auth()->user();
            if ($user->type === 'tourist') {
                if ($user->id === $review->tourist_id) {
                    $review->delete();
                    return response()->json("deleted successfully", 200);
                } else {
                    return response()->json(['message' => 'only the Owner Of The Review is Allowed to Delete.'], 403);
                }
            } else {
                return response()->json(['message' => 'Only tourists are allowed to delete reviews.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the review'], 500);
        }
    }
}
