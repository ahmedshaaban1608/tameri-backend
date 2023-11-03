<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
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

            $reviews = ReviewResource::collection(Review::paginate(20));
            return view('Review.index', ['data' => $reviews]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Review.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {


        try {
            if (Gate::allows('is-admin')) {
                $review = Review::create($request->all());
                return to_route('Review.index');
            } else {
                return abort(403, 'You are not allowed to create review.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the review.');

        }



    }


  public function show(Review $review)
{
    try {
        return view('Review.show', ['data' => new ReviewResource($review)]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }

}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Review.edit', ['data'=> $review]);
            } else{
                return abort(403, 'You are not allowed to edit this review.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {

        try {
            if (Gate::allows('is-admin')) {
                    $review->update($request->all());
                    return to_route('Review.index');

            } else {
                return abort(403, 'You are not allowed to update review.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the review.');

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
                        return to_route('Review.index');
                } else {
                    return abort(403, 'You are not allowed to delete area.');
                }
            } catch (\Exception $e) {
                return abort(500, 'An error occurred while deleting the area.');

            }

        }
    }
}
