<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Request $request): void
    {
        $faker = Faker::create();
        $adminRole = Role::where('slug', 'super-admin')->first();
        $user = new User();
        $user->uuid = $faker->uuid;
        $user->firstname = 'Tapas';
        $user->lastname = 'Sahoo';
        $user->email = 'tapasbca2015@gmail.com';
        $user->mobile_number = 9547614783;
        $user->email_verified_at = $faker->dateTime();
        $user->password = Hash::make('password');
        $user->is_active = 1;
        if ($user->save()) {
            $user->profile()->create([
                'user_id' => $user->id,
                'uuid' => $faker->uuid,
                'birthday' => '1997-05-04',
                'gender' => 'male',
                'state' => 'kolkata',
                'city' => 'Newtown'
            ]);
        }
        $user->roles()->attach($adminRole);
    }
}
