<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    public function store(StoreReviewRequest $request)
    {
       
        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                $tourguide = Tourguide::findOrFail($request->tourguide_id);
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
    public function update(UpdateReviewRequest $request, Review $review)
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

    public function destroy(Review $review)
    {

        try {
            if (Gate::allows('is-admin')) {
                $user = auth()->user();
                if ($review->tourist_id === $user->id) {
                    $review->delete();
                    return response()->json("deleted successfully", 200);
                }
            } else {
                return response()->json(['message' => 'only admins is Allowed to Delete.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the review'], 500);
        }
    }
}
