<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $user = auth()->user();

            if (Gate::allows('is-tourist')) {
                // $orders = OrderResource::collection(Order::all());
                $orders = OrderResource::collection(Order::where('tourist_id', $user->id)->get());
                return response()->json(['data' => $orders], 200);
            } elseif (Gate::allows('is-tourguide')) {
                $orders = OrderResource::collection(Order::where('tourguide_id', $user->id)->get());
                return response()->json(['data' => $orders], 200);
            } else {
                return response()->json(['message' => 'Only tourists or tourguides are allowed to view their orders.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'tourist_id' => 'required|numeric',
            'tourguide_id' => 'required|numeric',
            'comment' => 'required|string',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
            'from' => 'required|date',
            'to' => 'required|date',
            'total' => 'required|numeric',
            'city' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                $tourguide = Tourguide::findOrFail($request->tourguide_id);
                if (!$tourguide) {
                    return response()->json(['message' => 'Tourguide Id not found'], 404);
                }
                // $tourist = Tourist::findOrFail($request->tourist_id);
                // if (!$tourist) {
                //     return response()->json(['message' => 'Tourist Id not found'], 404);
                // }
                $request->merge(['tourist_id' => $user->id]);

                $order = Order::create($request->all());
                return response()->json(['message' => 'Order created successfully', 'data' => new OrderResource($order)], 201);
            } else {
                return response()->json(['message' => 'Only tourists are allowed to create orders.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the order.'], 500);
        }
    }

    public function show(Order $order)
    {
        try {
            $user = auth()->user();
            if (Gate::allows('is-tourguide')) {
                if ($order->tourguide_id === $user->id) {
                    return response()->json(new OrderResource($order), 200);
                } elseif (Gate::allows('is-tourist')) {
                    if ($order->tourist_id === $user->id) {
                        return response()->json(new OrderResource($order), 200);
                    }
                }
            } else {
                return response()->json(['message' => 'You are not allowed to view this order.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the order.'], 500);
        }
    }

    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            // 'tourist_id' => 'required|numeric',
            // 'tourguide_id' => 'required|numeric',
            'comment' => 'required|string',
            // 'phone' => 'required',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
            'from' => 'required|date',
            'to' => 'required|date',
            'total' => 'required|numeric',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            if (Gate::allows('action-by-tourist', $order)) {
                if ($order->status === 'pending') {
                    // $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    // if (!$tourguide) {
                    //     return response()->json(['message' => 'Tourguide Id not found'], 404);
                    // }
                    // $tourist = Tourist::findOrFail($request->tourist_id);
                    // if (!$tourist) {
                    //     return response()->json(['message' => 'Tourist Id not found'], 404);
                    // }
                    $order->update($request->all());
                    return response()->json(['message' => 'Order updated successfully', 'data' => new OrderResource($order)], 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this order.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the order.'], 500);
        }
    }
    public function destroy(Order $order)
    {
        try {
            if (Gate::allows('action-by-tourist', $order)) {
                $order->delete();
                return response()->json(['message' => 'Order deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'only the Owner Of The order is Allowed to Delete.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the order.'], 500);
        }
    }
}
