<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MJErwin\Clockwork\ClockworkClient;
use MJErwin\Clockwork\Message;
use App\Http\Requests;

class ClockworkController extends Controller{

    protected $client, $message;

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

        $this->message->setNumber($request->input('telephone'));
        $this->message->setContent('Testing Clockwork SMS #HackathonStarter');

        $this->client->sendMessage($this->message);
        return redirect()->back()->with('info','Your Message has been sent successfully');
    }
}
