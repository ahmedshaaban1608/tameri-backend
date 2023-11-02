<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $report = ReportResource::collection(Report::all());
            return response()->json(['data' => $report], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
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


    public function show(Report $report)
    {
        try {
            return response()->json(new ReportResource($report), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);



        }
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Report $report)
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
