<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Review;
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
            return response( $review, 200);

        } catch (\Exception $e) {
            return response( "not valid", 500);
        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
                $validator = Validator::make($request->all(), [
                    'tourist_id'=> 'required|numeric',
                    'tourguide_id'=> 'required|numeric',
                    'title' => 'required',
                    'comment' => 'required|string',
                    'stars' => 'required',

                ]);

                if ($validator->fails()) {

                    return response( $validator->errors()->all(), 422);
                }


                    $review = Review::create($request->all());
                    return response( $review, 200);
            }catch (\Exception $e) { return response( "not valid", 500);}





    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        try {
            return response( $review, 200);

        } catch (\Exception $e) {
            return response( "not valid", 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
        try {
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

            $review->update($request->all());
            return response( $review, 200);
    }catch (\Exception $e) { return response( "not valid", 500);}



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
            return response( "not valid", 500);
        }

    }
}
