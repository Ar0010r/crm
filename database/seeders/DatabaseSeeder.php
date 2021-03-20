<?php

namespace Database\Seeders;

use App\Models\User;
use App\Shared\Value\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' => 'Admin',
            'role' => Role::ADMIN,
            'password' => bcrypt(11111111)
        ]);

        User::create([
            'login' => 'Hr',
            'role' => Role::HR,
            'password' => bcrypt(11111111)
        ]);

        User::create([
            'login' => 'Personnel',
            'role' => Role::PERSONNEL,
            'password' => bcrypt(11111111)
        ]);
    }
}
