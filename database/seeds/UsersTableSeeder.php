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
        DB::table('users')->truncate();
        App\Models\User::create([
        	'name' => 'hoaiphuong',
        	'email' =>'hoaiphuong2527@gmail.com',
            'password' => bcrypt('123Admin'),
            'phone'     => '1234567',
            'user_role' => 0,
            'created_by'  => null,
            'created_at'  =>'2018-05-23 00:00:00',
            'updated_by'  => null,
            'updated_at'  => '2018-05-23 00:00:00',
        ]);
    }
}
