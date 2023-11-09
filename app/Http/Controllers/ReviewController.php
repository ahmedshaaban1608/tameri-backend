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
        // $this->middleware('auth');
        $this->middleware(['auth','isadmin']);

    }
    public function index()
    {
        //
        try {

            $reviews = ReviewResource::collection(Review::orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(40));
            return view('Dashboard.admin', ['reviews' => $reviews]);
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


  public function show($id)
{
    try {
        $review = Review::findOrFail($id);
        return view('Review.show',['review' => $review]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }

}



    /**
     * Show the form for editing the specified resource.
     */
  
    public function edit($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $review = Review::find($id);
                if ($review) {
                    return view('Review.edit', ['review' => $review]); 
                } else {
                    return redirect()->route('users')->with('error', 'User not found.');
                }
            } else {
                return abort(403, 'You are not allowed to edit this user.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
    /**
     * Update the specified resource in storage.
     */


//     public function update(Request $request, $id)
// {
//     try {
//         $review = Review::find($id);

//         if ($review) {
//             if (Gate::allows('is-admin')) {
//                 $review->update([
//                     'title' => $request->input('title'),
//                     'comment' => $request->input('comment'),
//                     'status' => $request->input('status'),
//                 ]);

//                 return redirect()->route('reviews')->with('success', 'Review updated successfully.');
//             } else {
//                 return abort(403, 'You are not allowed to update the review.');
//             }
//         } else {
//             return redirect()->back()->with('error', 'Review not found.');
//         }
//     } catch (\Exception $e) {
//         return abort(500, 'An error occurred while updating the review.');
//     }
// }
public function update(Request $request, $id)
{
    try {
        $review = Review::find($id);

        if ($review) {
            if (Gate::allows('is-admin')) {
                if ($request->input('status_action') === 'declined') {
                    $review->update(['status' => 'declined']); 
                    return redirect()->route('reviews')->with('success', 'Review status updated to declined successfully.');
                } elseif ($review->status === 'pending' && in_array($request->input('status_action'), ['confirmed'])) {   
                     $newStatus = $request->input('status_action');
                    $review->update(['status' => $newStatus]);
                    return redirect()->route('reviews')->with('success', 'Review status updated to ' . $newStatus . ' successfully.');
                } else {
                    $review->update([
                        'title' => $request->input('title'),
                        'comment' => $request->input('comment'),
                        'status' => $request->input('status'),
                    ]);

                    return redirect()->route('reviews')->with('success', 'Review updated successfully.');
                }
            } else {
                return abort(403, 'You are not allowed to update the review.');
            }
        } else {
            return redirect()->back()->with('error', 'Review not found.');
        }
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while updating the review: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $review = Review::findOrFail($id);
                $review->delete();
              
                return back()->with('success', 'review deleted successfully.');
            } else {
                return abort(403, 'You are not allowed to delete review.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the review.');
        }
    }
}
