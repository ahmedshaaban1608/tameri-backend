<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
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
            return response()->json( ['data'=>$report], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        //

            // $validator = Validator::make($request->all(), [
            //     'user_id'=> 'required|numeric',
            //     'subject' => 'required|string',
            //     'problem' => 'required|string',
            //     'image' => 'required|string',

            // ]);

            // if ($validator->fails()) {

            //     return response( $validator->errors()->all(), 422);
            // }
            try {
                $user = User::findOrFail($request->user_id);
                if($user['type']!=='tourist'){
                    return response()->json(['message' => 'user is not a tourist.'], 403);
                }
            } catch (\Throwable $th) {
                return response()->json(['message' => 'not valid user id.'], 403);
            }
            try {
            $report = Report::create($request->all());
            return response()->json( ['message' => 'Report Created successfully','data'=>new ReportResource($report)], 200);


        }catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the report'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
        try {
            return response()->json( new ReportResource($report), 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);

        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {

        // $validator = Validator::make($request->all(), [
        //     'subject' => 'required|string',
        //     'problem' => 'required|string',
        //     'image' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response( $validator->errors()->all(), 422);
        // }
        try {
            $user = User::findOrFail($request->user_id);
            if($user['type']!=='tourist'){
                return response()->json(['message' => 'user is not a tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'not valid user id.'], 403);
        }
        try {
        $report->update($request->all());
        return response()->json(['message' => 'Report updated successfully', 'data' => new ReportResource($report)], 200);

    }catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while updating the report'], 500);
    }


        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
        try {
            $report->delete();
            return response()->json("deleted successfully", 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the report'], 500);
        }

    }
}
