<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
use Session;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToProvider(Request $request,$provider){
        if($request->has('redirect')){
            Session::put('oldPath', $request->input('redirect'));
        }
        return Socialite::with($provider)->redirect();
    }

    public function handleProviderCallback($provider){
        try{
            $user = Socialite::with($provider)->user();
        }catch(Exception $e){
            return redirect('/auth/' . $provider);
        }

        if(Auth::user()){
            $this->updateUserProfile($user, $provider);
            $redirectPath = Session::has('oldPath') ? Session::get('oldPath') : "/account";
            Session::forget('oldPath');
            return redirect($redirectPath);
        } else {
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser);

            return redirect('/');
        }
    }

    private function updateUserProfile($userData, $provider){
        $existingUser = User::find(Auth::user()->id);
        $userProfile = new UserProfile([
            'provider' => $provider,
            'provider_id' => $userData->id,
            'oauth_token' => $userData->token,
            'oauth_token_secret' => property_exists($userData, "tokenSecret") ? $userData->tokenSecret : null
        ]);
        $existingUser->userProfile()->save($userProfile);
    }

    private function findOrCreateUser($userData, $provider){
        $profile = UserProfile::whereProvider($provider)->where('provider_id', '=', $userData->id)->first();
        $realUser = User::find($profile['user_id']);
        if($realUser){
            return $realUser;
        }

        $user = new User();
        $user->name = $userData->name;
        $user->username = $userData->getNickName();
        $user->avatar = $userData->getAvatar();
        $user->email = $userData->email;
        $user->save();

        $profile = new UserProfile();
        $profile->provider = $provider;
        $profile->provider_id = $userData->id;
        $profile->oauth_token = $userData->token;
        $profile->oauth_token_secret = property_exists($userData, "tokenSecret") ? $userData->tokenSecret : null;
        $user->userProfile()->save($profile);

        return $user;
    }
}
