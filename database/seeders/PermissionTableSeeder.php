<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-requests',
            'user-edit',
            'user-delete',
            'user-ban',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'events',
            'events-edit',
            'event-delete',
            'group',
            'group-edit',
            'group-delete',
            'settings',
            'settings-edit',
            'database',
            'database-backup',
            'database-clear',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
