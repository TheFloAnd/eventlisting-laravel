<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $settings = new SettingsSeeder();
        $settings->run();


        // Creates Permissions
        $settings = new PermissionTableSeeder();
        $settings->run();

        // Creates Roles
        $settings = new RolesSeeder();
        $settings->run();

        // Creates User and assigns Roles to it
        $settings = new UserSeeder();
        $settings->run();
    }
}
