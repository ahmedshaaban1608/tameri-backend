<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

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
            return response()->json(['data'=> $review], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //

                // $validator = Validator::make($request->all(), [
                //     'tourist_id'=> 'required|numeric',
                //     'tourguide_id'=> 'required|numeric',
                //     'title' => 'required|string',
                //     'comment' => 'required|string',
                //     'stars' => 'required|in:1,2,3,4,5',

                // ]);

                // if ($validator->fails()) {

                //     return response( $validator->errors()->all(), 422);
                // }

                try {
                    $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    $tourist = Tourist::findOrFail($request->tourist_id);
                    $review = Review::create($request->all());
                    return response()->json( ["message"=>"Review created successfully",'data'=>new ReviewResource($review)], 200);
            }catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while creating the review'], 500);
            }
          }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        try {
            return response()->json(new ReviewResource($review), 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //

            // $validator = Validator::make($request->all(), [
            //     'tourist_id'=> 'required|numeric',
            //     'tourguide_id'=> 'required|numeric',
            //     'title' => 'required',
            //     'comment' => 'required|string',
            //     'stars' => "required|in:1,2, 3, 4, 5",
            //     'status' => "required|in:pending,confirmed,declined"

            // ]);

            // if ($validator->fails()) {

            //     return response( $validator->errors()->all(), 422);
            // }
            try {
                $tourguide = Tourguide::findOrFail($request->tourguide_id);
                $tourist = Tourist::findOrFail($request->tourist_id);
            $review->update($request->all());
            return response()->json(["message"=>"Review updated successfully",'data'=>new ReviewResource($review)], 200);
    }catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while updating the review'], 500);
    }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //

        try {
            $review->delete();
            return response()->json("deleted successfully", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the review'], 500);
        }

    }
}
