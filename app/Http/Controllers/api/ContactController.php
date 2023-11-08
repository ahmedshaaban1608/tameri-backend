<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact(Request $request){
      
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=> 'required|email',
            'subject'=>'required|string',
            'message'=>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
            Mail::to('support@ta-meri.com')->send(new ContactUsMail($data));
            return response()->json(['message'=> 'message sent successfully'],200);
        } catch (\Throwable $th) {
            return response()->json(['error'=> $th],500);
        }


    }
}
