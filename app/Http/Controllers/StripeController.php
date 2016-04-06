<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StripeController extends Controller{

    public function index(){
        return view('api.stripe');
    }
}
