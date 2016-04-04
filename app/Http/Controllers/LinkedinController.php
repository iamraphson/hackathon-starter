<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Happyr\LinkedIn\LinkedIn;
use App\UserProfile;
use App\Http\Requests;
use Auth;

class LinkedinController extends Controller{

    protected $linkedIn;

    public function __construct(){
        $this->linkedIn = new LinkedIn(env('LINKEDIN_ID'), env('LINKEDIN_SECRET'));
    }

    public function index(Request $request){
        $tokenData = $this->getLinkedinToken();
        if(!$tokenData){
            return redirect('auth/linkedin?redirect=' . $request->path());
        } else {
            $this->linkedIn->setAccessToken($tokenData->oauth_token);
            $linkedinUser = $this->getData();
            print_r($linkedinUser);
            return view('api.linkedin')->withUser($linkedinUser);
        }

    }

    private function getLinkedinToken(){
        return UserProfile::whereProvider('linkedin')->where('user_id', '=', Auth::user()->id)->first();
    }

    private function getData(){
        return $this->linkedIn
            ->get('v1/people/~:(firstName,lastName,num-connections,public-profile-url,positions,emailAddress,pictureUrl,location,industry)');
    }

}
