<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lob\Lob;
use App\Http\Requests;

class LobController extends Controller{

    protected $lob;

    public function __construct(){
        $this->lob = new Lob(env('LOB__ID'));
    }

    public function index(){
        $response = $this->getRoutes(array(10007));
        return view('api.lob')->withDatas($response[0]['routes']);
    }

    public function getRoutes($zipCode){
         return (array)$this->lob->routes()->all(array('zip_codes' => $zipCode));
    }
}
