<?php

namespace App\Domain\Services\Statistics;

use App\Domain\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TodayStatisticsService
{
    public static function get (\DateTimeInterface $today)
    {
        $yesterday = Carbon::parse($today)->subDay();
        while ($yesterday->isWeekend()){
            $yesterday->subDay();
        }

        $today = $today->format('Y-m-d');
        $yesterday = $yesterday->format('Y-m-d');
        $todaySent = DB::table('mail_logs')
                ->selectRaw('SUM(processed) as processed')
                ->where('created_at', '>', $today)
                ->first()->processed ?? 0;

        $yesterdaySent = DB::table('mail_logs')
                ->selectRaw('SUM(processed) as processed')
                ->where('created_at', '>', $yesterday)
                ->where('created_at', '<', $today)
                ->first()->processed ?? 0;
        $new = Employee::query()->where('created_at', '>', $today)->count();
        $hired =Employee::query()->where('hired_at', '>', $today)->count();
        return [
            'new' => $new,
            'hired' => $hired,
            'sent' => $todaySent,
            'bounce' => round(($yesterdaySent > 0 ? round($new / $yesterdaySent, 4) :  0) * 100, 2),
        ];
    }
}
