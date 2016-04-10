<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MJErwin\Clockwork\ClockworkClient;
use MJErwin\Clockwork\Message;
use App\Http\Requests;

class ClockworkController extends Controller{

    protected $client;
    protected $message;

    public function __construct(){
        $this->client = new ClockworkClient(env('CLOCKWORK_ID'));
        $this->message = new Message();
    }

    public function index(){
        return view('api.clockwork');
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'telephone'     => 'required|numeric'
        ]);

        $number = $request->input('telephone');
        $this->message->setNumber($number);
        $this->message->setContent('Testing Clockwork SMS #HackathonStarterEV');

        $this->client->sendMessage($this->message);
        return redirect()->back()->with('info','Your Message has been sent successfully');
    }
}
