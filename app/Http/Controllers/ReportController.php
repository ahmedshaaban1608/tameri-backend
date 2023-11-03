<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
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

            $report = ReportResource::collection(Report::all());
            return view('Report.index', ['data' => $report]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Report.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {

        try {
            if (Gate::allows('is-admin')) {
                $report = Report::create($request->all());
                return to_route('Report.index');
            } else {
                return abort(403, 'You are not allowed to create report.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the report.');

        }
        // try {
        //     if (Gate::allows('is-admin')) {
        //         $report = Report::create($request->all());
        //         return response()->json(['message' => 'Report created successfully', 'data' => new ReportResource($report)], 200);
        //     }

        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'An error occurred while creating the report'], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        try {
        return view('Report.show', ['data' => new ReportResource($report)]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Report.edit', ['data'=> $report]);
            } else{
                return abort(403, 'You are not allowed to edit this report.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        try {
            if (Gate::allows('is-admin')) {
                    $report->update($request->all());
                    return to_route('Report.index');

            } else {
                return abort(403, 'You are not allowed to update report.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the report.');

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
                    return to_route('Report.index');
            } else {
                return abort(403, 'You are not allowed to delete report.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the report.');

        }

    
    }
}
