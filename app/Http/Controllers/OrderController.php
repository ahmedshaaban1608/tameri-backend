<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Gate;

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

            $orders = OrderResource::collection(Order::paginate(20));
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
        //
    }

    /**
     * Display the specified resource.
     */
   
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return view('Order.show', ['order' => $order]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
   
     public function edit($id)
     {
         try {
             if (Gate::allows('is-admin')) {
                 $order = Order::find($id);
                 if ($order) {
                     return view('Order.edit', ['order' => $order]); 
                 } else {
                     return redirect()->route('users')->with('error', 'User not found.');
                 }
             } else {
                 return abort(403, 'You are not allowed to edit this user.');
             }
         } catch (\Exception $e) {
             return abort(500, 'An error occurred while retrieving the data.');
         }
     }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

        if ($order) {
            if (Gate::allows('is-admin')) {
            $order->update([
                'comment' => $request->input('comment'),
                'city' => $request->input('city'),
                
            ]);
            return redirect()->route('orders')->with('success', 'order updated successfully.');
        } else {
            return abort(403, 'You are not allowed to update the tourguide.');
        }
    } else {
        return back()->with('error', 'Tourguide not found.');
    }
} catch (\Exception $e) {
    return back()->with('error', 'An error occurred while updating the tourguide.');
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
