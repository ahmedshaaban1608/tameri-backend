<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use DateTime;



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
                $orders = OrderResource::collection(Order::where('tourist_id', $user->id)->get());
                return response()->json(['data' => $orders], 200);
            } else if (Gate::allows('is-tourguide')) {
                $orders = OrderResource::collection(Order::where('tourguide_id', $user->id)->get());
                return response()->json(['data' => $orders], 200);
            } else {
                return response()->json(['message' => 'Only tourists or tourguides are allowed to view their orders.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(StoreOrderRequest $request)
    {
     


        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                $tourguide = Tourguide::findOrFail($request->tourguide_id);
                if (!$tourguide) {
                    return response()->json(['message' => 'Tourguide Id not found'], 404);
                }
                $request->merge(['tourist_id' => $user->id]);
                $requestTo = new DateTime($request->to);
                $requestFrom = new DateTime($request->from);
                $timeDifference = $requestTo->getTimestamp() - $requestFrom->getTimestamp();
                $days = ceil($timeDifference / (60 * 60 * 24))+1;
                $total = $tourguide->day_price * $days;
                $request->merge(['total' => $total]);
                $order = Order::create($request->all());
                return response()->json(['message' => 'Order created successfully', 'data' => new OrderResource($order)], 200);
            } else {
                return response()->json(['message' => 'Only tourists are allowed to create orders.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the order.', 'error'=> $e], 500);
        }
    }



    public function show(Order $order)
    {
        try {
            $user = auth()->user();
            if (Gate::allows('is-tourguide')) {
                if ($order->tourguide_id === $user->id) {
                    return response()->json(new OrderResource($order), 200);
                } 
            } else if (Gate::allows('is-tourist')) {
                if ($order->tourist_id === $user->id) {
                    return response()->json(new OrderResource($order), 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to view this order.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the order.'], 500);
        }
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
       
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($order->tourguide_id === $user->id) {
                    $order->update([
                        'status'=> $request->status,
                    ]);
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
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($order->tourist_id === $user->id) {
                    $order->delete();
                    return response()->json(['message' => 'Order deleted successfully'], 200);
                } 
            } else {
                return response()->json(['message' => 'only the Owner Of The order is Allowed to Delete.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the order.'], 500);
        }
    }
}
