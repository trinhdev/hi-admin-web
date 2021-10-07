<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'group_id' => 1,
                'name' => 'User',
                'username' => 'User 1',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
                
            ],
            [
                'group_id' => 2,
                'name' => 'Admin',
                'username' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ]
        ]);

        DB::table('users_group')->insert([
            [
                'group_name' => 'Group User',
                'p_category_id' => 1,
            ],
            [
                'group_name' => 'Group Admin',
                'p_category_id' => 5,
            ]
        ]);


        DB::table('permission')->insert([
            [
                'permission_type' => 'CREATE_USER',
                'permission_code' => 'USER_NORMAL',
                'user_id'         => 1,
                'p_category_id'   => 1,
                'permitted'       => true
            ],
            [
                'permission_type' => 'UPDATE_USER',
                'permission_code' => 'USER_NORMAL',
                'user_id'         => 1,
                'p_category_id'   => 1,
                'permitted'       => false,
            ]
        ]);


        DB::table('permission_categories')->insert([
            [
                'p_category_name' => 'CRUD User',
            ],
            [
                'p_category_name' => 'CRUD Admin',
            ]
        ]);
    }
}
