<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        try {
            $tourists = TouristResource::collection(Tourist::all());
            return response()->json(['data' => $tourists], 200);
        } catch (\Throwable $th) {
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z]{3,}(?:\s[a-zA-Z]{3,})*$/',
            'email' => 'required|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:6|max:15',
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $data = $request->all();


        try {
            $user = User::create([
                'type' => 'tourist',
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            $data['id'] = $user->id;
            $tourist = Tourist::create($data);
            return response()->json(['data' => new TouristDataResource($tourist)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating the tourist', 'error' => $th], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tourist $tourist)
    // {
    //     //
    // }
    public function show()
    {
        $tourists = Tourist::all();
        return view('Dashboard.tourists', ['tourists' => $tourists]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Tourist $tourist)
    {
        //
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => ['required', 'regex:/^\+?\d{7,14}$/', Rule::unique('tourists')->ignore($tourist)],
        ]);




        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($tourist->id === $user->id) {
                    $tourist->update($request->all());
                    // Return the tourist
                    return response()->json(['data' => new TouristDataResource($tourist)], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the tourist'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        //
        try {
            // Delete the tourist
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($tourist->id === $user->id) {

                    $tourist->delete();

                    // Return a success message
                    return response()->json([
                        'message' => 'Tourist deleted successfully.'
                    ], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to delete this tourist.'], 403);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to delete this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourist'], 500);
        }
    }
}
