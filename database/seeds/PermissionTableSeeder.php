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

        DB::table('permissions')->insert([
            'name' => 'permission-read'
        ]);

        DB::table('permissions')->insert([
            'name' => 'permission-write'
        ]); 

        DB::table('permissions')->insert([
            'name' => 'permission-edit'
        ]);

        DB::table('permissions')->insert([
            'name' => 'permission-delete'
        ]);   


        DB::table('permissions')->insert([
            'name' => 'category-read'
        ]); 

        DB::table('permissions')->insert([
            'name' => 'category-write'
        ]);

        DB::table('permissions')->insert([
            'name' => 'category-edit'
        ]); 

        DB::table('permissions')->insert([
            'name' => 'category-delete'
        ]);   


        DB::table('permissions')->insert([
            'name' => 'menu-read'
        ]); 

        DB::table('permissions')->insert([
            'name' => 'menu-write'
        ]);

        DB::table('permissions')->insert([
            'name' => 'menu-edit'
        ]); 

        DB::table('permissions')->insert([
            'name' => 'menu-delete'  
        ]); 

    }
}
