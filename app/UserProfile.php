<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_profile';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider', 'provider_id', 'oauth_token', 'oauth_token_secret'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
