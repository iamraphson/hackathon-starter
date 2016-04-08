<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SlackUser;
use SlackChat;
use App\Http\Requests;

class SlackController extends Controller{

    public function index(){
        $teamList = (array)SlackUser::lists();
        return view('api.slack')->withTeam($teamList['members']);
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'message'     => 'required'
        ]);

        $msg = $request->input('message') . " #HackathonStarterEV :wink:";

        SlackChat::message('#general', $msg);

        return redirect()->back()->with('info', 'Your Message has been sent successfully');
    }
}
