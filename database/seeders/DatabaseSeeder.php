<?php

namespace Database\Seeders;

use App\Models\User;
use App\Properties\Role;
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
            'login' => 'Arthur',
            'role' => Role::ADMIN,
            'password' => bcrypt(11111111)
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
