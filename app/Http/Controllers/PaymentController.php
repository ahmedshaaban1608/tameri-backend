<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function show($id){
        $user = auth()->user();
        $order = Order::findOrFail($id);
        if($user->id === $order->tourist_id){     
        $tourist = Tourist::where("id",$order->tourist_id)->first();
        $tourguide = Tourguide::where("id",$order->tourguide_id)->first();
        return view('Payment.payorder', ['order'=> $order, 'tourist'=>$tourist,'tourguide'=>$tourguide]);
        }
        return abort(403,'You are not allowed to access this page');
    }
    

    public function charge(Request $request)
    {
        try {

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $data = [
                // 'productname' => $request->name,
                // 'cardNumber' => $request->input('cardNumber'),
                // 'CVC' => $request->input('CVC'),
                // 'expMonth' => $request->input('expMonth'),
                'id' => $request->id,
                'currency' => 'usd',
                'amount' => $request->price
            ];
        
            $customer = Customer::create(
                array(
                    'email' => $request->stripeEmail,
                    'source' => $request->stripeToken
                )
            );
            $charge = Charge::create(
                array(
                    'customer' => $customer->id,
                    "amount" => $data['amount'] * 100,
                    'currency' => $data['currency'],
                )
            );
                $order = Order::where('id', $data['id'])->first();
              if($order){
                  $order->update([
                    'payment'=> 'paid',
                ]);
              }
           
            return redirect(env('FRONTEND_URL').'/profile');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }


    }
}
