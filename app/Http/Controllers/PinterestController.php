<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DirkGroenen\Pinterest\Pinterest;
use App\UserProfile;
use App\Http\Requests;

class PinterestController extends Controller{

    protected $client;

    public function __construct(){
        $this->client = new  Pinterest(env('PINTEREST_ID'),env('PINTEREST_SECRET'));
    }

    public function index(Request $request){
        if(!$this->isSecure()){
            return view('api.pinterest')->with('notSecure', true);
        }

        $tokenData = $this->getPinterestToken();
        if(!$tokenData){
            return redirect('auth/pinterest?redirect=' . $request->path());
        } else {
            $this->setToken($tokenData->oauth_token);
            $boards = $this->client->users->getMeBoards()->all();
            return view('api.pinterest')->with('boards', $boards);
        }
    }

    private function setToken($token){
        $this->client->auth->setOAuthToken($token);
    }

    private function getPinterestToken(){
        return UserProfile::whereProvider('pinterest')->where('user_id', '=', Auth::user()->id)->first();
    }

    public function postPin(Request $request){
        $this->validate($request, [
            'board'     => 'required',
            'note'     => 'required|min:3',
            'link'     => 'required',
            'image_url'     => 'required',
        ]);

        $note = $request->input('note');
        $board = $request->input('board');
        $link = $request->input('link');
        $image_url = $request->input('image_url');

        $this->client->pins->create(array(
            "note"          => $note,
            "image_url"     => $image_url,
            "board"         => $board,
            "link"          => $link
        ));

        return redirect()->back()->with('info', 'Your Pin has been sent successfully');
    }

    private function isSecure() {
        return
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || $_SERVER['SERVER_PORT'] == 443;
    }
}
