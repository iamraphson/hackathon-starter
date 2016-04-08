<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio;
use App\Http\Requests;

class TwilioController extends Controller{

    public function index(){
        return view('api.twilio');
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'number'     => 'required',
            'message'     => 'required'
        ]);

        $number = $request->input('number');
        $message = $request->input('message') . " #HackathonStarter";

        Twilio::message($number, $message);


        return redirect()->back()->with('info','Your Message has been sent successfully');
    }
}
