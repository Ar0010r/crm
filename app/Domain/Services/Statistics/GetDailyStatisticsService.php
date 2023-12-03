<?php

namespace App\Domain\Services\Statistics;

use App\Domain\Models\Employee;
use App\Domain\Models\Letter;
use App\Domain\Models\MailLog;
use App\Domain\Models\User;
use App\System\Shared\DateService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GetDailyStatisticsService
{
    public static function hiredStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): Collection
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = self::getStaffIds($staff);

        return Employee::query()
            ->selectRaw('DATE(hired_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('hired_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('hired_at', '>=', $from))
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->orderBy('day')->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (int)$v->count])
            ->map(fn($x) => is_array($x) ? ($x[0] ?? 0) : 0);

    }

    public static function relativeHiredStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): Collection
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = self::getStaffIds($staff);

        return Employee::query()
            ->selectRaw('DATE(created_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            ->whereNotNull('hired_at')
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->orderBy('day')->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (int)$v->count])
            ->map(fn($x) => is_array($x) ? ($x[0] ?? 0) : 0);
    }

    public static function addedStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): Collection
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = self::getStaffIds($staff);

        return Employee::query()
            ->selectRaw('DATE(created_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (int)$v->count])
            ->map(fn($x) => is_array($x) ? ($x[0] ?? 0) : 0);
    }

    public static function sendingStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): Collection
    {
        $to = $to?->format('Y-m-d');
        $from = $from?->format('Y-m-d');
        $ids = self::getStaffIds($staff);

        return MailLog::query()->selectRaw('DATE(created_at) AS day, SUM(processed) AS processed, wave')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            /* ->where('created_at', '>=', $from)
             ->where('created_at', '<=', $to)*/
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day', 'wave'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (array)$v]);
    }

    public static function mailStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): Collection
    {
        $to = $to?->format('Y-m-d');
        $from = $from?->format('Y-m-d');
        $ids = self::getStaffIds($staff);

        return Letter::query()->selectRaw('DATE(received_at) AS day, SUM(total) AS total')
            ->when(is_string($to), fn(Builder $v) => $v->where('received_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('received_at', '>=', $from))
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy('day')->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (int)$v->total])
            ->map(fn($x) => is_array($x) ? ($x[0] ?? 0) : 0);

    }

   private static function getStaffIds(Collection $staff): Collection
   {
       return $staff->map(fn($x) => match (true) {
           $x instanceof User => $x->getKey(),
           Str::isUuid($x) => $x,
           default => null,
       })->whereNotNull();
   }

}
