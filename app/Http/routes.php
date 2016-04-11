<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('customer/{id}', 'CustomerController@customer');


Route::get('customer_name', function(){
    $customer  = App\Customer::where('name', '=', 'segun')->first();
    echo $customer->id;
});


Route::get('orders', function(){
    $orders = App\Order::all();
    foreach($orders as $order){
        echo $order->name . "Ordered By " . $order->customer->name . "<br/>";
    }
});


Route::get('mypage', function(){
    $data = array('var1' => 'Hello', 'var2' => 'World', 'orders' => App\Order::all());
    return view('mypage')->with('data', $data);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {

    Route::get('/', function(){
        return view('welcome');
    });

    Route::get('/home', [
        'uses' => 'HomeController@index'
    ]);
    Route::group(['prefix' => '/api'], function () {
        Route::get('/', function(){
            return view('apiPage');
        });

        Route::get('/facebook', [
            'middleware' => ['auth'],
            'uses' => 'FacebookController@index'
        ]);

        Route::get('/twitter', [
            'middleware' => ['auth'],
            'uses' => 'TwitterController@index'
        ]);

        Route::get('/github', [
            'middleware' => ['auth'],
            'uses' => 'GithubController@index'
        ]);

        Route::get('/foursquare', [
            'middleware' => ['auth'],
            'uses' => 'FoursquareController@index'
        ]);

        Route::get('/instagram', [
            'middleware' => ['auth'],
            'uses' => 'InstagramController@index'
        ]);

        Route::get('/linkedin', [
            'middleware' => ['auth'],
            'uses' => 'LinkedinController@index'
        ]);

        Route::get('/lastfm', [
            'middleware' => ['auth'],
            'uses' => 'LastFmController@index'
        ]);

        Route::get('/nyt', [
            'middleware' => ['auth'],
            'uses' => 'NewYorkTimesController@index'
        ]);
        Route::get('/stripe', [
            'middleware' => ['auth'],
            'uses' => 'StripeController@index'
        ]);
        Route::get('/paypal', [
            'middleware' => ['auth'],
            'uses' => 'PayPalController@index'
        ]);

        Route::get('/paypal/checkout', [
            'middleware' => ['auth'],
            'uses' => 'PayPalController@getCheckout'
        ]);

        Route::get('/paypal/done', [
            'middleware' => ['auth'],
            'uses' => 'PayPalController@getDone'
        ]);

        Route::get('/paypal/cancel', [
            'middleware' => ['auth'],
            'uses' => 'PayPalController@getCancel'
        ]);

        Route::get('/tumblr', [
            'middleware' => ['auth'],
            'uses' => 'TumblrController@index'
        ]);

        Route::get('/scraping', [
            'middleware' => ['auth'],
            'uses' => 'ScarpingController@index'
        ]);

        Route::get('/clockwork', [
            'middleware' => ['auth'],
            'uses' => 'ClockworkController@index'
        ]);

        Route::post('/clockwork', [
            'middleware' => ['auth'],
            'uses' => 'ClockworkController@sendMessage'
        ]);

        Route::get('/lob', [
            'middleware' => ['auth'],
            'uses' => 'LobController@index'
        ]);

        Route::get('/twilio', [
            'middleware' => ['auth'],
            'uses' => 'TwilioController@index'
        ]);

        Route::post('/twilio', [
            'middleware' => ['auth'],
            'uses' => 'TwilioController@sendMessage'
        ]);

        Route::get('/slack', [
            'middleware' => ['auth'],
            'uses' => 'SlackController@index'
        ]);

        Route::post('/slack/sendmessage', [
            'middleware' => ['auth'],
            'uses' => 'SlackController@sendMessage'
        ]);

        Route::get('/pinterest', [
            'middleware' => ['auth'],
            'uses' => 'PinterestController@index'
        ]);

        Route::post('/pinterest/pin/new', [
            'middleware' => ['auth'],
            'uses' => 'PinterestController@postPin'
        ]);

        Route::get('/upload', [
            'middleware' => ['auth'],
            'uses' => 'UploadController@index'
        ]);

        Route::post('/upload/apply', [
            'middleware' => ['auth'],
            'uses' => 'UploadController@upload'
        ]);

    });

    Route::post('newtweet/send',[
        'middleware' => ['auth'],
        'uses' => 'TwitterController@sendTweet'
    ]);
    Route::get('/account', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@index'
    ]);

    Route::post('/account/profile', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@updateProfile'
    ]);

    Route::post('/account/password', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@changePassword'
    ]);
    Route::post('/account/photo', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@uploadAvatar'
    ]);

    Route::get('/account/unlink/{provider}', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@unlinkSocialMediaAccount'
    ]);

    Route::get('/account/delete', [
        'middleware' => ['auth'],
        'uses' => 'AccountController@deleteAccount'
    ]);




    Route::get('/login', [
        'uses' => 'Auth\AuthController@getLogin',
        'as' => 'auth.login',
        'middleware' => ['guest']
    ]);

    Route::post('/login', [
        'uses' => 'Auth\AuthController@postLogin',
        'middleware' => ['guest']
    ]);

    Route::get('/logout', [
       'uses' => 'Auth\AuthController@logout',
        'as' => 'logout'
    ]);

    Route::get('/register', [
        'uses' => 'Auth\AuthController@getRegister',
        'as' => 'auth.register',
        'middleware' => ['guest']
    ]);

    Route::post('/register', [
        'uses' => 'Auth\AuthController@postRegister',
        'middleware' => ['guest']
    ]);


    Route::get('/contact', [
        'uses' => 'ContactController@index'
    ]);

    Route::post('/contact', [
        'uses' => 'ContactController@sendMessage'
    ]);

    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\PasswordController@getReset');


    Route::get('/auth/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('/auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


});
