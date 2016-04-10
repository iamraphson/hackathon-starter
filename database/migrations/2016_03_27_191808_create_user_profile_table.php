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
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('oauth_token')->nullable();
            $table->string('oauth_token_secret')->nullable();
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
