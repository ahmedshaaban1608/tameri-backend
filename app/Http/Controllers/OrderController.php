<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Order $order)
    // {
    //     //
    // }
  
public function show($id)
{
    // $orders = Order::all();
    // return view('Dashboard.order', ['orders' => $orders]); 
    $order = Order::find($id);
    return view('Dashboard.order.showOrder', ['order' => $order]);
}
    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Order $order)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Order $order)
    // {
    //     //
    // }

    public function edit($id)
    {
           $order = Order::find($id);
        return view('Dashboard.order.editOrder', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
    
        if ($order) {
            $order->update([
                'comment' => $request->input('comment'),
                'city' => $request->input('city'),
                // 'avatar' => $request->input('avatar'),
                // 'phone' => $request->input('phone'),
            ]);
    
            return redirect()->route('orders')->with('success', 'order updated successfully.');
        } else {
            return redirect()->back()->with('error', 'order not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
