<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tumblr;
use App\Http\Requests;

class TumblrController extends Controller{

    protected $api;
    protected $blogAddress;

    public function __construct(){
        $this->api = new Tumblr();
        $this->blogAddress = "jasonnjoku.tumblr.com";
        $this->api->setApiKey(env('TUMBLR_ID'));
    }

    public function index(){
        return view('api.tumblr')->withPosts($this->getBlogPosts());
    }

    public function getBlogInfo(){
       return  (array)$this->api->blogInfo($this->blogAddress);
    }

    public function getBlogPosts(){
        return (array) $this->api->posts($this->blogAddress);
    }
}
