<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
Use Auth;
Use Twitter;
use App\Http\Requests;

class TwitterController extends Controller{

    private $searchItem;
    public function __construct(){
        $this->searchItem = "Laravel";
    }

    public function index(Request $request){
        $tokenData = $this->getTwitterToken();
        if(!$tokenData){
            return redirect('auth/twitter?redirect=' . $request->path());
        } else {
            $searchTweet = json_decode($this->searchTweet());
            return view('api.twitter')->withTweets($searchTweet->statuses);
        }
    }

    public function searchTweet(){
        return Twitter::getSearch(['q' => $this->searchItem, 'count' => 10, 'format' => 'json']);
    }



    public function sendTweet(Request $request){
        $this->validate($request, [
            'tweet'     => 'required'
        ]);

        $tweet = $request->input('tweet') . " #LaravelHackthonv2.0";
        Twitter::postTweet(['status' => $tweet, 'format' => 'json']);
        return redirect()->back()->with('info', 'Your Message has been sent successfully');
    }
    private function getTwitterToken(){
        return UserProfile::whereProvider('twitter')->where('user_id', '=', Auth::user()->id)->first();
    }
}
