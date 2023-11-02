<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {

            try {
                    $orders = OrderResource::collection(Order::all());
                    return response()->json(['data' => $orders], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
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

        // try {
        //     if (Gate::allows('is-admin')) {
        //         $order = Order::create($request->all());
        //         return response()->json(['message' => 'Order created successfully', 'data' => new OrderResource($order)], 201);
        //     } else {
        //         return response()->json(['message' => 'Only admins are allowed to create orders.'], 403);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'An error occurred while creating the order.'], 500);
        // }
    }

public function show(Order $order)
{
    return view('Dashboard.order', ['data' => $order]); 
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
    
        try {
            if (Gate::allows('is-admin')) {
                
                    $order->update($request->all());
                    return response()->json(['message' => 'Order updated successfully', 'data' => new OrderResource($order)], 200);
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
