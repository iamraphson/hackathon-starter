<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \FoursquareApi;
use \App\UserProfile;
use Auth;
use App\Http\Requests;

class FoursquareController extends Controller{

    protected $foursquare;

    public function __construct(){
        $this->foursquare = new FoursquareApi(env('FOURSQUARE_ID'), env('FOURSQUARE_SECRET'));
    }

    public function index(Request $request){
        $tokenData = $this->getFoursquareToken();
        if(!$tokenData){
            return redirect('auth/foursquare?redirect=' . $request->path());
        } else {
            $response = json_decode($this->getData('Lagos, Nigeria'), true);
            return view('api.foursquare')->withLocations($response['response']['venues']);
        }
    }

    private function getFoursquareToken(){
        return UserProfile::whereProvider('foursquare')->where('user_id', '=', Auth::user()->id)->first();
    }

    private function getData($endPoint){
        return $this->foursquare->GetPublic("venues/search", array("near"=> $endPoint), $POST=false);
    }
}
