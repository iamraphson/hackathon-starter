<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserProfile;
use Auth;
use Larabros\Elogram\Client;
use League\OAuth2\Client\Token\AccessToken;

class InstagramController extends Controller{

    protected $instagramClient;
    protected $userId;

    public function __construct(){
        $this->instagramClient = new Client(env('INSTAGRAM_ID'), env('INSTAGRAM_SECRET'), null, '');
        $this->userId = 'self';
    }

    public function index(Request $request){
        $tokenData = $this->getInstagramToken();
        if(!$tokenData){
            return redirect('auth/instagram?redirect=' . $request->path());
        } else {
            //form access token
            $accessToken = $this->getAccessTokenStr($tokenData->oauth_token);

            //Set access token
            $this->instagramClient->setAccessToken(new AccessToken(array("access_token"=> $accessToken)));

            $username = $this->searchByUsername('iamraphson');

            $userById = $this->searchByUserId(224366365);
            $recentMedia = $this->recentMedia();
            return view('api.instagram')->withUsername($username)
                ->with('userbyid', $userById)->with('recentMedia', $recentMedia);
        }
;
    }


    private function getInstagramToken(){
        return UserProfile::whereProvider('instagram')->where('user_id', '=', Auth::user()->id)->first();
    }

    private function getAccessTokenStr($token){
        return json_encode(array("access_token" => $token));
    }

    private function searchByUsername($username){
        return $this->instagramClient->users()->find($username)->get();
    }

    private function searchByUserId($id){
        return $this->instagramClient->users()->get($id)->get();
    }

    private function recentMedia(){
        return $this->instagramClient->users()->getMedia($this->userId)->get();
    }
}
