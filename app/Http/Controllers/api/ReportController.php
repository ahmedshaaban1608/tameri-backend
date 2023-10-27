<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $report = Report::all();
            return response( $report, 200);

        } catch (\Exception $e) {
            return response( "not valid", 500);
        }




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'user_id'=> 'required|numeric',
                'subject' => 'required|string',
                'problem' => 'required',
                'image' => 'required',

            ]);

            if ($validator->fails()) {

                return response( $validator->errors()->all(), 422);
            }

            $report = Report::create($request->all());
            return response( $report, 200);


        }catch (\Exception $e) { return response( "not valid", 500);}

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
        try {
            return response( $report, 200);

        } catch (\Exception $e) {
            return response( "not valid", 500);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
    try {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'problem' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response( $validator->errors()->all(), 422);
        }
        $report->update($request->all());
        return response( $report, 200);

    }catch (\Exception $e) { return response( "not valid", 500);}


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
            return response("deleted successfully", 200);
        } catch (\Exception $e) {
            return response( "not valid", 500);
        }
    
    }
}
