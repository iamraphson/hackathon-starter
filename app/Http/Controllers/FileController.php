<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FileController extends Controller{

    public function showImg($file){
        $path = storage_path().'/app';

        $pathFile = $path . '/' . $file;

        if (!file_exists($pathFile) || !is_file($pathFile)) {
            $pathFile = $path . '/img/no-image.jpg';
        }
        $imgInfo = getimagesize($pathFile);
        header('Content-type: '.$imgInfo['mime']);
        readfile($pathFile);
    }
}
