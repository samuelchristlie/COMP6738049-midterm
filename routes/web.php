<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\Coffee;
use App\Models\Transaction;
use Illuminate\Support\Str;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    // return view("welcome");
    if( session()->has("session") ){
        return redirect("home");
    } else {
        return redirect("login");
    }
});

Route::get("home", function () {
    
    if( session()->has("session") ){
        $customer = Customer::where("session", session("session"))->first();
        
        if (!$customer){
            return redirect("login")->with("error", "Invalid session!");    
        } else {
            return view("home", ["customer" => $customer]);
        }
    } else {
        return redirect("login");
    }
});

Route::get("coffee", function () {
    
    if( session()->has("session") ){
        $customer = Customer::where("session", session("session"))->first();
        
        if (!$customer){
            return redirect("login")->with("error", "Invalid session!");    
        } else {
            $coffees = Coffee::all();
            return view("drinks", ["customer" => $customer, "coffees"=>$coffees]);
        }
    } else {
        return redirect("login");
    }
});

Route::get("coffee-{category}", function ($category) {
    
    if( session()->has("session") ){
        $customer = Customer::where("session", session("session"))->first();
        
        if (!$customer){
            return redirect("login")->with("error", "Invalid session!");    
        } else {
            $coffees = Coffee::where("category", Str::title($category))->get();
            return view("drinks", ["customer" => $customer, "coffees"=>$coffees]);
        }
    } else {
        return redirect("login");
    }
});


Route::get("login", function () {
    if( session()->has("session") ){
        return redirect("home");
    } else {
        return view("login");
    }
});

Route::post("login",
    [App\Http\Controllers\loginController::class, "processForm"]
);

Route::get("register", function () {
    if( session()->has("session") ){
        return redirect("home");
    } else {
        return view("register");
    }
});

Route::post("register",
    [App\Http\Controllers\registerController::class, "processForm"]
);

Route::get("logout", function () {
    if( session()->has("session") ){
        session()->flush();
        return redirect("/");
    } else {
        return redirect("login");
    }
});

Route::post("buy",
    [App\Http\Controllers\buyController::class, "processForm"]
);

Route::get("history", function () {
    
    if( session()->has("session") ){
        $customer = Customer::where("session", session("session"))->first();
        
        if (!$customer){
            return redirect("login")->with("error", "Invalid session!");    
        } else {
            $transactions = Transaction::where("customerId", $customer->id)->get()->sortByDesc('timestamp');
            return view("history", ["customer" => $customer, "transactions" => $transactions]);
        }
    } else {
        return redirect("login");
    }
});