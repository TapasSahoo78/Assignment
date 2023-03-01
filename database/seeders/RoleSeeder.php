<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Role();
        $admin->name = 'Super Admin';
        $admin->slug = 'super-admin';
        $admin->save();

        $admin = new Role();
        $admin->name = 'User';
        $admin->slug = 'user';
        $admin->save();
    }
}
