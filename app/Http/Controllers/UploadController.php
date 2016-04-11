<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;

class UploadController extends Controller{

    public function index(){
        return view('api.upload');
    }

    public function upload(Request $request){
        $this->validate($request, [
            'myFile'     => 'required|between:1,7000'
        ]);

        $file = $request->file('myFile');

        $fileName = $request->file('myFile')->getClientOriginalName();

        Storage::put(time() . round(microtime(true) * 1000) . '/' . $fileName,  File::get($file));

        return redirect()->back()->with('info', 'File was uploaded successfully.');
    }
}
