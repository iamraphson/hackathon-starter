<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;

class AccountController extends Controller{

    protected $loginId;

    public function __construct(){
        $this->loginId = Auth::user()->id;
    }

    public function index(){
        $accountDetails = User::find($this->loginId);
        return view('account.profile')->withAccount($accountDetails);
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
}
