<?php

namespace Database\Seeders;

use App\Domain\Models\Employee;
use App\Domain\Models\User;
use App\Domain\Enums\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (User::query()->count() == 0) {
            $this->demoUsers();
        }

        DB::table('personal_access_tokens')->where('tokenable_type', 'App\Models\User')
            ->update(['tokenable_type' => User::class]);

        DB::table('media')->where('model_type', 'App\Models\Employee')
            ->update(['model_type' => Employee::class]);
    }

    private function demoUsers()
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

    private function setRandomContactDates()
    {
        $dates = collect(
            [
                '2022-01-10 01:10:53',
                '2022-01-09 18:10:53',
                '2022-01-09 13:10:53',
                '2022-01-08 13:10:53',
                '2022-01-07 13:10:53',
            ]
        );


        Employee::query()->whereNull('contacted')->take(500)->get()
            ->map(function (Employee $employee) use ($dates) {
                $employee->update(['contacted' => $dates->random()]);
            });


    }
}
