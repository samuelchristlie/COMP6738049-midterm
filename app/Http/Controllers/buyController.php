<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Coffee;
use App\Models\Transaction;

class buyController extends Controller
{
    public function processForm(Request $request){
        if(!session()->has("session") ){
            return redirect("login");
        } 

        $customer = Customer::where("session", session("session"))->first();

        if (!$customer){
            return redirect("login")->with("error", "Invalid session!");    
        } 

        $coffee = Coffee::where("id", $request->coffeeId)->first();

        if (!$coffee){
            return redirect("coffee");
        } 
        

        $transaction = Transaction::create([
            "customerId" => $customer->id,
            "coffeeId" => $coffee->id,
            "price" => $coffee->price,
        ]);


        $transaction -> save();

        $customer->increment("loyalty");
        $customer-> save();

        return redirect("history");

        
    }

    
}
