<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $review = Review::all();
            return response( ['data'=>$review], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
     
                $validator = Validator::make($request->all(), [
                    'tourist_id'=> 'required|numeric',
                    'tourguide_id'=> 'required|numeric',
                    'title' => 'required|string',
                    'comment' => 'required|string',
                    'stars' => 'required|in:1,2,3,4,5',

                ]);

                if ($validator->fails()) {

                    return response( $validator->errors()->all(), 422);
                }
                
                try {
                    $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    $tourist = Tourist::findOrFail($request->tourist_id);
                    $review = Review::create($request->all());
                    return response( ['data'=>$review], 200);
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
            return response( ['data'=>$review], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
        
            $validator = Validator::make($request->all(), [
                'tourist_id'=> 'required|numeric',
                'tourguide_id'=> 'required|numeric',
                'title' => 'required',
                'comment' => 'required|string',
                'stars' => "required|in:'1','2', '3', '4', '5'",
                'status' => "required|in:'pending', 'confirmed','declined'"

            ]);

            if ($validator->fails()) {

                return response( $validator->errors()->all(), 422);
            }
            try {
                $tourguide = Tourguide::findOrFail($request->tourguide_id);
                $tourist = Tourist::findOrFail($request->tourist_id);
            $review->update($request->all());
            return response( ['data'=>$review], 200);
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
            return response("deleted successfully", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the review'], 500);
        }

    }
}
