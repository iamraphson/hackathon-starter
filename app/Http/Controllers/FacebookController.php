<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserProfile;
use Facebook;

use App\Http\Requests;

class FacebookController extends Controller{
    public function index(Request $request){
        $tokenData = $this->getFacebookToken();
        if(!$tokenData){
            return redirect('auth/facebook?redirect=' . $request->path());
        } else {
            try {
                $dataFromFacebook = json_decode($this->getData($tokenData)->getGraphUser(), true);
            } catch (Exception $e) {
                $this->deleteFacebookToken();
                return redirect('auth/facebook?redirect=' . $request->path());
            }
            return view('api.facebook')->with('details', $dataFromFacebook);
        }

    }

    private function getFacebookToken(){
        return UserProfile::whereProvider('facebook')->where('user_id', '=', Auth::user()->id)->first();
    }

    private function deleteFacebookToken(){
        return UserProfile::whereProvider('facebook')->where('user_id', '=', Auth::user()->id)->delete();
    }

    private function getData($data){
        return Facebook::get
            ('/me?fields=id,name,email,first_name,last_name,gender,link,locale,timezone,picture', $data->oauth_token);
    }
}
