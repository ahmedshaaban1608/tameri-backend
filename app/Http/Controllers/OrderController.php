<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
            return view('Order.index', ['data' => $orders]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        try {
            if (Gate::allows('is-admin')) {
                $order = Order::create($request->all());
                return to_route('Order.index');
            } else {
                return abort(403, 'You are not allowed to create order.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the order.');

        }

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
    try {
        return view('Order.show', ['data' => new OrderResource($order)]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }

}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Order.edit', ['data'=> $order]);
            } else{
                return abort(403, 'You are not allowed to edit this order.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {

        try {
            if (Gate::allows('is-admin')) {
                    $order->update($request->all());
                    return to_route('Order.index');

            } else {
                return abort(403, 'You are not allowed to update order.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the order.');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        try {
            if (Gate::allows('is-admin')) {

                    $order->delete();
                    return to_route('Order.index');
            } else {
                return abort(403, 'You are not allowed to delete order.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the order.');

        }



    }
}
