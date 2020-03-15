<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // lets create user
        // you can use create as we have already fillable set up
        // create and add user to a avariable
       $user=  App\User::create([
          'name'=>'sample',
          'email'=>'sample@sample.com',
           'password'=> bcrypt('sample'), //laravel uses bcrypt to make password secured
           'isAdmin'=>1,
        ]);
        // create profile for this admin using model
        // lets search for a default avatar
        App\Profile::create([
          'user_id'=>$user->id,
          'avatar'=>'uploads/avatar.jpg', //avatar/link
          'about'=>'Lorem ipsum dolor sit amet,
           consectetur adipisicing elit.',
           'facebook'=>'facebook.com',
        ]);
    }
}
