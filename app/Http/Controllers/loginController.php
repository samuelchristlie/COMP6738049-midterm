<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;

class loginController extends Controller
{
    public function processForm(Request $request){
        $error = "";

        $rules = [
            "user" => "required",
            "pass" => "required",
        ];

        $messages = [
            "user.required" => "The username field is required",
            "pass.required" => "The password field is required"
        ];

        $validated = $request->validate($rules, $messages);

        $user = $request->user;
        $pass = $request->pass;

        // $customer = Customer::where("user", $user)->where("password", bcrypt($pass))->first();
        $customer = Customer::where("user", $user)->where("password", hash("sha256", $pass))->first();
        if ($customer) {
            $newSession = hash("sha256", $user.now());
            $customer->session = $newSession;
            $customer->save();
            session(["session" => $newSession]);
            return redirect("home");
        } else {
            $error = "No matching credentials found!";
            return view("login", ["error" => $error]);
        }
    }
}
