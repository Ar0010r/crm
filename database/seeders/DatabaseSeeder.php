<?php

namespace Database\Seeders;

use App\Domain\Enums\Period;
use App\Domain\Models\Employee;
use App\Domain\Models\Subscription;
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

        Subscription::all()->whereInstanceOf(Subscription::class)
            ->each(function (Subscription $subscription) {
                $subscription->update([
                    "next_payment" => $this->nextPayment($subscription)
                ]);
            });
    }

    public function nextPayment(Subscription $subscription)
    {
        if ($subscription->last_payment && is_string($subscription->period)) {
            return match ($subscription->period) {
                Period::MONTHLY => $subscription->last_payment->addMonth()->format('Y-m-d'),
                Period::QUARTERLY => $subscription->last_payment->addMonths(3)->format('Y-m-d'),
                Period::HALF_YEARLY => $subscription->last_payment->addMonths(6)->format('Y-m-d'),
                Period::YEARLY => $subscription->last_payment->addYear()->format('Y-m-d'),
                default => null
            };
        }

        return null;
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

   /* private function nextPayment(Subscription $subscription)
    {
        return match ($this->period) {
            Period::MONTHLY => $this->last_payment->addMonth()->format('Y-m-d'),
            Period::QUARTERLY => $this->last_payment->addMonths(3)->format('Y-m-d'),
            Period::HALF_YEARLY => $this->last_payment->addMonths(6)->format('Y-m-d'),
            Period::YEARLY => $this->last_payment->addYear()->format('Y-m-d'),
            default => null
        };
    }*/

}
