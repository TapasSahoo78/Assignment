<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /*** Create permissions List as Array ***/

        $permissions = [
            [
                'name' => 'User.List',
                'slug' => 'user.list'
            ],
            [
                'name' => 'User.Create',
                'slug' => 'user.create'
            ],
            [
                'name' => 'User.Edit',
                'slug' => 'user.edit'
            ],
            [
                'name' => 'User.Delete',
                'slug' => 'user.delete'
            ],
            [
                'name' => 'Role.List',
                'slug' => 'role.list'
            ],
            [
                'name' => 'Role.Create',
                'slug' => 'role.create'
            ],
            [
                'name' => 'Role.Edit',
                'slug' => 'role.edit'
            ],
            [
                'name' => 'Role.Delete',
                'slug' => 'role.delete'
            ]
        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionName = $permissions[$i]['name'];
            $permissionSlug = $permissions[$i]['slug'];
            Permission::create([
                'name' => $permissionName,
                'slug' => $permissionSlug
            ]);
        }
    }
}
