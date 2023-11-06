<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Models\Review;
use App\Models\Order;
use App\Models\Tourist;
use App\Models\Tourguide;
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
        // $this->middleware('auth');
        $this->middleware('isadmin');
    }
    // public function index()
    // {
    //     //
    //     try {

    //         $reports = ReportResource::collection(Report::paginate(20));
    //         return view('Report.index', ['data' => $reports]);
    //     } catch (\Exception $e) {
    //         return abort(500, 'An error occurred while retrieving the data.');
    // }

    // }

    public function index()
{
    try {
        $reports = ReportResource::collection(Report::paginate(20));
        $tourguidesCount = Tourguide::count();
        $touristsCount = Tourist::count();
        $reviewsCount = Review::count();
        $ordersCount = Order::count();
        return view('Dashboard.admin', [ 'reports' => $reports,
        'tourguidesCount' => $tourguidesCount  ,
        'touristsCount' => $touristsCount,
         'reviewsCount' => $reviewsCount ,
         'ordersCount' => $ordersCount 
        ]);
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
