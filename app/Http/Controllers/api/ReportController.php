<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            
            $report = ReportResource::collection(Report::where('tourist_id', Auth::id())->get());
            return response()->json(['data' => $report], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }


    public function store(StoreReportRequest $request)
    {
        try {
            $user = User::id();
            $request->merge(['user_id' => User::id()]);
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
            if($report->user_id === Auth::id()){
            return response()->json(new ReportResource($report), 200);
        } else {
            return response()->json(['message' => 'Not allowed.'], 403);
        }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
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
