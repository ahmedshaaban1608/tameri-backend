<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $report = ReportResource::collection(Report::all());
            return response()->json(['data' => $report], 200);
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'subject' => 'required|string',
            'problem' => 'required|string',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }

        try {
            $user = User::findOrFail($request->user_id);

            if ($user->type !== 'tourist' && $user->type !== 'tourguide') {
                return response()->json(['message' => 'User is not a tourist or a tour guide.'], 403);
            }

            $report = Report::create($request->all());
            return response()->json(['message' => 'Report created successfully', 'data' => new ReportResource($report)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the report'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        try {
            return response()->json(new ReportResource($report), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);



        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Report $report)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'problem' => 'required|string',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }


        try {
            if (Gate::allows('is-admin')) {
                $report->update($request->all());
                return response()->json(['message' => 'Report updated successfully', 'data' => new ReportResource($report)], 200);
            } else {
                return response()->json(['message' => 'You are not allowed to update this report.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the report'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        try {
            if (Gate::allows('is-admin')) {

                $report->delete();
                return response()->json("deleted successfully", 200);
            } else {
                return response()->json(['message' => 'Only admins are allowed to delete reports.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the report'], 500);
        }

    }
}
