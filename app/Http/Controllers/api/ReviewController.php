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
        $review = Review::all();

        return  $review;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

$validator = Validator::make($request->all(), [
    'tourist_id'=> 'required',
    'tourguide_id'=> 'required',
    'title' => 'required',
    'comment' => 'required',
    'stars' => 'required',

]);

if ($validator->fails()) {

    return response( $validator->errors()->all(), 422);
}

$review = Review::create($request->all());
return $review;




    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        return $review;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //

$validator = Validator::make($request->all(), [
    'tourist_id'=> 'required',
    'tourguide_id'=> 'required',
    'title' => 'required',
    'comment' => 'required',
    'stars' => 'required',
    'status' => 'required'

]);

if ($validator->fails()) {

    return response( $validator->errors()->all(), 422);
}
$review->update($request->all());
return $review;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
        $review->delete();
        return "deleted successfully";
    }
}
