<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(\CodeProject\Entities\User::class)->create([
	        'name' => 'Vitor',
	        'email' => 'vitorvqz@gmail.com',
	        'password' => bcrypt(123456),
	        'remember_token' => str_random(10)
    	]);
    }
}
