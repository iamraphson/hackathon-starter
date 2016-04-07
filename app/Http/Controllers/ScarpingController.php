<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Http\Requests;

class ScarpingController extends Controller{

    protected $client;
    protected $url;
    public function __construct(){
        $this->client = new Client();
        $this->url = "https://news.ycombinator.com/";
    }

    public function getLinks(){
        $crawler = $this->client->request('GET', $this->url);
        $arr = $crawler->filter('.title a[href^="http"], a[href^="https"]')->each(function ($node) {
            $links = [];
            array_push($links, $node->text());
            return $links;

        });

        return $arr;
    }
    public function index(){

        return view('api.scraping')->withDatas($this->getLinks());
    }
}
