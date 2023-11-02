<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
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

    /**
     * Display the specified resource.
     */
    // public function show(Order $order)
    // {
    //     //
    // }
<<<<<<< HEAD
<<<<<<< HEAD

public function show()
{

    $orders = Order::all();
    return view('Dashboard.order', ['orders' => $orders]);
=======
=======
>>>>>>> 38bd3d0f367c13bd4e027d09a89b2a0ba795fe16
   
public function show()
{
    
    $orders = Order::all();
    return view('Dashboard.order', ['orders' => $orders]); 
<<<<<<< HEAD
>>>>>>> 38bd3d0f367c13bd4e027d09a89b2a0ba795fe16
=======
>>>>>>> 38bd3d0f367c13bd4e027d09a89b2a0ba795fe16
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Order $order)
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
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($order->tourist_id === $user->id && $order->status === 'pending') {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($order->tourist_id === $user->id) {
                    $order->delete();
                    return response()->json(['message' => 'Order deleted successfully'], 200);
                } else {
                    return response()->json(['message' => 'only the Owner Of The order is Allowed to Delete.'], 403);
                }
            } else {
                return response()->json(['message' => 'only the Owner Of The order is Allowed to Delete.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the order.'], 500);
        }
    }
}
