<?php

use CodeEduUser\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'name' => config('codeeduuser.user_default.name'),
            'email' => config('codeeduuser.user_default.email'),
            'password' => bcrypt(config('codeeduuser.user_default.password')),
            'verified' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->forceDelete();
    }
}
