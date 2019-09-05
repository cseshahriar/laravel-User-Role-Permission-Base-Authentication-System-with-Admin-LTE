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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('shahriar'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => bcrypt('shahriar'),
            'remember_token' => Str::random(10),
        ]); 
    }
}
