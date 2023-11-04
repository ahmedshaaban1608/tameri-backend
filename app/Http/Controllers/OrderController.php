<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
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
    // public function show(Order $order)
    // {
    //     //
    // }
   
public function show()
{
    
    $orders = Order::all();
    return view('Dashboard.order', ['orders' => $orders]); 
}
    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
   
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
