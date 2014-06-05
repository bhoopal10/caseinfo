<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($user)
        {
            $user->increments('id');
            $user->string('user_name',50);
            $user->string('first_name',50);
            $user->string('last_name',50);
            $user->string('email',65);
            $user->string('password',100);
            $user->string('password_tmp',100);
            $user->int('profilesId',11);
            $user->char('banned',1);
            $user->char('suspended',1);
            $user->string('code',100);
            $user->char('active',1);
            $user->string('remember_token',100);
            $user->timestamp('updated_at');
            $user->enum('type',array('private','public'));

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('users');
	}

}
