<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users_profile', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->integer('user_id')->unsigned();
            $table->string('provider_id');
            $table->string('provider');
            $table->string('oauth_token');
            $table->string('oauth_token_secret');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('users_profile');
    }
}
