<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'gender', 'location', 'website', 'avatar', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function userProfile(){
        return $this->hasMany('App\UserProfile', 'user_id');
    }

    /*
     * Check if Avatar field is null
     * @return model avatar
     */
    public function getAvatar(){
        if(is_null($this->avatar))
            return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mm&s=60";

        return $this->avatar;
    }
}