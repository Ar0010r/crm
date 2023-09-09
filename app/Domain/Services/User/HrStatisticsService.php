<?php

namespace App\Domain\Services\User;

use App\Domain\Models\Employee;
use Illuminate\Support\Carbon;

class HrStatisticsService
{
    public function calculate($from, $to)
    {
        $to = Carbon::parse($to);
        $from = Carbon::parse($from);

        Employee::query()
            ->where('created_at', '>=', $from->format('Y-m-d h:m:s'))
            ->where('created_at', '<=', $to->format('Y-m-d h:m:s'))
            ->select([
                'count(*) as count',
            ]);

    }

}
