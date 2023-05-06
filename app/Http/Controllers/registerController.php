<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

class registerController extends Controller
{
    public function processForm(Request $request){
        $error = "default";

        $user = $request->user;
        $name = $request->name;
        $pass = $request->pass;



        $rules = [
            "user" => "required|unique:customers,user",
            "name" => "required|alpha|min:3",
            "pass" => "required|min:6",
        ];

        $messages = [
            "user.required" => "The username field is required",
            "user.unique" => "The username has already been taken",
            "name.required" => "The name field is required",
            "name.alpha" => "The name field must contain only alphabetic characters",
            "name.min" => "The name field must be at least 3 characters",
            "pass.required" => "The password field is required",
            "pass.min" => "The password field must be at least 6 characters",
        ];



        $validated = $request->validate($rules, $messages);

        $customer = Customer::create([
            "name" => $name,
            "user" => $user,
            // "password" => bcrypt($pass),
            "password" => hash('sha256', $pass),
        ]);

        $customer -> save();

        $error = "You may login now!";
        return view("register", ["error" => $error]);



        
    }
    
}
