<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Moderator',
            'email' => 'moderator@email.com',
            'password' => bcrypt('password'),
        ]);
    }
}
