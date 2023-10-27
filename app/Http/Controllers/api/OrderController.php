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
        try {
            $orders = Order::all();
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred.'], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tourist_id' => 'required|numeric',
                'tourguide_id' => 'required|numeric',
                'comment' => 'required|string',
                'phone' => 'required',
                // 'phone' => 'required|numeric|digits_between:10,12',
                'from' => 'required|date',
                'to' => 'required|date',
                'total' => 'required|numeric',
                'city' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $order = Order::create($request->all());

            return response()->json(['order' => $order], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the order.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
            return response()->json(['area' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the order.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tourist_id' => 'required|numeric',
                'tourguide_id' => 'required|numeric',
                'comment' => 'required|string',
                'phone' => 'required',
                // 'phone' => 'required|numeric|digits_between:10,12',
                'from' => 'required|date',
                'to' => 'required|date',
                'total' => 'required|numeric',
                'city' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $order->update($request->all());

            return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the order.'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        try {
            $order->delete();
            return response()->json(['message' => 'Order deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the order.'], 500);
        }
    }
}
