<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([ 
            'name' => 'user-read'
        ]);

        DB::table('permissions')->insert([
            'name' => 'user-write'
        ]);

        DB::table('permissions')->insert([
            'name' => 'user-edit'
        ]);

        DB::table('permissions')->insert([
            'name' => 'user-delete'
        ]);
    }
}
