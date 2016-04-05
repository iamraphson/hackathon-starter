<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Requests;

class NewYorkTimesController extends Controller{

    protected $url;
    protected $client;
    protected  $response;
    public function __construct(){
        $this->url = "http://api.nytimes.com/svc/books/v3/lists?list-name=young-adult&api-key=" . env('NEWYORKTIMES_ID');
        $this->client = new Client();
        $this->makeRequest();
    }

    public function index(){
        $res = $this->getResponse();
        return view('api.newyorktimes')->withBooks($res['results']);
    }

    public function getResponse(){
        return json_decode($this->response->getBody(), true);
    }

    public function makeRequest(){
        $this->response = $this->client->get($this->url);
    }
}
