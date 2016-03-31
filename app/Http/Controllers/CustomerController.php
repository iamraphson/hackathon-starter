<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Customer as Customer;

class CustomerController extends Controller{
    public function customer($id){
        $customer = Customer::find($id);

        return view('customer')->with('customer', $customer);
    }
}
