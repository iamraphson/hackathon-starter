<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cloudder;
use Session;
use App\Http\Requests;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AccountController extends Controller{

    protected $loginId;

    public function __construct(){
        $this->loginId = Auth::user()->id;
    }

    public function index(){
        $accountDetails = User::find($this->loginId);
        $linkedAccount = array();
        foreach($accountDetails->userProfile as $profile){
            array_push($linkedAccount, strtolower($profile->provider));
        }
        return view('account.profile')->withAccount($accountDetails)->with("linkedAccount",$linkedAccount);
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'email'     => 'required|email',
            'name'   => 'required|min:3'
        ]);

        $user = User::find($this->loginId);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->location = $request->input('location');
        $user->website = $request->input('website');
        $user->username = $request->input('username');
        $user->save();

        return redirect()->back()->with('info', 'Your Profile has been updated successfully');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'password'     => 'required|min:4|confirmed',
            'password_confirmation'   => 'required|min:4'
        ]);

        $user = User::find($this->loginId);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('info', 'Password has been changed successfully');

    }

    /*
     * Avatar upload using cloudinary(https://www.cloudinary.com)
     */
    public function uploadAvatar(Request $request){
        $this->validate($request, [
            'file_name'     => 'required|mimes:jpg,jpeg,bmp,png|between:1,7000',
        ]);

        /*
         * API implementation for Cloudder..
         */
        /*
            $file = $request->file('file_name')->getRealPath();
            Cloudder::upload($file, null);
            list($width, $height) = getimagesize($file);
            $fileUrl = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);
        */
        /*
         * End of cloudder api implementation.
         */



        /*
         * Local Storage imeplementation
         */

        $file = $request->file('file_name');

        $fileName =  time() . rand(0, 9999) . "/" . $request->file('file_name')->getClientOriginalName();

        Storage::put($fileName,  File::get($file));//store image in local storage

        $fileUrl = url('img/' . $fileName);//generate image url


        /*
         * End of local storage implementation.
         */


        //store File URL to DB
        $this->saveUpload($fileUrl);

        return redirect()->back()->with('info', 'Photo has been updated successfully');
    }

    public function saveUpload($fileUrl){
        $user = User::find($this->loginId);
        $user->avatar = $fileUrl;
        $user->save();
    }

    public function unlinkSocialMediaAccount($provider){
        UserProfile::whereProvider($provider)->where('user_id', '=', Auth::user()->id)->delete();
        return redirect()->back()->with('info', 'Account has been unlinked');
    }

    public function deleteAccount(Request $request){
        User::find($this->loginId)->delete();
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
