<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $report = Report::all();

        return  $report;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

$validator = Validator::make($request->all(), [
    'subject' => 'required',
    'problem' => 'required',
    'image' => 'required',

]);

if ($validator->fails()) {

    return response( $vaidator->errors()->all(), 422);
}

$report = Report::create($request->all());
return $report;




    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
        return $report;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'problem' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response( $vaidator->errors()->all(), 422);
        }
        $report->update($request->all());
        return $report;


        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
        $report->delete();
        return "deleted successfully";
    }
}
