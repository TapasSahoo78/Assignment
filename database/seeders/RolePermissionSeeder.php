<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'super-admin')->first();

        /** Get Last Insert Id **/
        $role_id = $adminRole->id;

        $permissions = Permission::all();

        foreach ($permissions as $key => $value) {
            DB::table('roles_permissions')->insert(
                [
                    'role_id' => $role_id,
                    'permission_id' => $value->id
                ]
            );
        }
    }
}
