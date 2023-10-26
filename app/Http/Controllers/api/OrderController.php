<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        return $order;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'phone' => 'required',
            'from' => 'required',
            'to' => 'required',
            'total' => 'required',
            'city' => 'required',

        ]);
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
        $order = Order::create($request->all());
        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    { {
            $validator = Validator::make($request->all(), [
                'comment' => 'required',
                'phone' => 'required',
                'from' => 'required',
                'to' => 'required',
                'total' => 'required',
                'city' => 'required',
            ]);
            if ($validator->fails()) {
                return response($validator->errors()->all(), 422);

            }
            $order->update($request->all());
            return $order;
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return "deleted";
    }
}
