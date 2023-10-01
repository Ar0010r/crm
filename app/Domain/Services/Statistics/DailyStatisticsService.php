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
use Illuminate\Support\Str;

class DailyStatisticsService
{
    public static function hiredStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff)
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = $staff->map(fn($x) => match (true) {
            $x instanceof User => $x->getKey(),
            Str::isUuid($x) => $x,
            default => null,
        })->whereNotNull()/*->join("', '")*/
        ;

        return Employee::query()
            ->selectRaw('DATE(hired_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('hired_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('hired_at', '>=', $from))
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (array)$v])
            ->toArray();

        /*   $q = "SELECT DATE(created_at) AS day,SUM(processed) AS sum, wave
                   FROM mail_logs
                   WHERE created_at >= '$from' AND created_at <= '$to'
                   and hr_id in ('$ids')
                   GROUP BY day, wave;";*/

    }

    public static function relativeHiredStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff)
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = $staff->map(fn($x) => match (true) {
            $x instanceof User => $x->getKey(),
            Str::isUuid($x) => $x,
            default => null,
        })->whereNotNull()/*->join("', '")*/
        ;

        return Employee::query()
            ->selectRaw('DATE(created_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            ->whereNotNull('hired_at')
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (array)$v])
            ->toArray();

        /*   $q = "SELECT DATE(created_at) AS day,SUM(processed) AS sum, wave
                   FROM mail_logs
                   WHERE created_at >= '$from' AND created_at <= '$to'
                   and hr_id in ('$ids')
                   GROUP BY day, wave;";*/

    }

    public static function addedStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff)
    {
        $to = $to?->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d h:m:s');
        $ids = $staff->map(fn($x) => match (true) {
            $x instanceof User => $x->getKey(),
            Str::isUuid($x) => $x,
            default => null,
        })->whereNotNull()/*->join("', '")*/
        ;

        return Employee::query()
            ->selectRaw('DATE(created_at) AS day, COUNT(*) AS count')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            /*->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)*/
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (array)$v])
            ->toArray();
    }

    public static function mailStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff)
    {
        $to = $to?->format('Y-m-d');
        //$to = $to->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d');
        //$from = $from->format('Y-m-d h:m:s');
        $ids = $staff->map(fn($x) => match (true) {
            $x instanceof User => $x->getKey(),
            Str::isUuid($x) => $x,
            default => null,
        })->whereNotNull()/*->join("', '")*/
        ;

        return MailLog::query()->selectRaw('DATE(created_at) AS day, SUM(processed) AS processed, wave')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            /* ->where('created_at', '>=', $from)
             ->where('created_at', '<=', $to)*/
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy(['day', 'wave'])->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (array)$v])->toArray();

        /*   $q = "SELECT DATE(created_at) AS day,SUM(processed) AS sum, wave
                   FROM mail_logs
                   WHERE created_at >= '$from' AND created_at <= '$to'
                   and hr_id in ('$ids')
                   GROUP BY day, wave;";*/

    }

    public static function totalMailStats(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff)
    {
        $to = $to?->format('Y-m-d');
        //$to = $to->format('Y-m-d h:m:s');
        $from = $from?->format('Y-m-d');
        //$from = $from->format('Y-m-d h:m:s');
        $ids = $staff->map(fn($x) => match (true) {
            $x instanceof User => $x->getKey(),
            Str::isUuid($x) => $x,
            default => null,
        })->whereNotNull();

        return Letter::query()->selectRaw('DATE(received_at) AS day, SUM(total) AS total')
            ->when(is_string($to), fn(Builder $v) => $v->where('received_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('received_at', '>=', $from))
            ->whereIn('hr_id', $ids->toArray())
            ->groupBy('day')->toBase()->get()
            ->mapToDictionary(fn($v) => [$v->day => (int)$v->total])
            ->map(fn($x) => $x[0] ?? 0)
            ->toArray();
            //->mapToDictionary(fn($v) => [$v->day => (int)$v->total])->toArray();

    }

    public static function calculateBounce(Collection $mail, Collection $added)
    {
        $days = array_merge(array_keys($mail->toArray()), array_keys($added->toArray()));
        //$days = ;

        return collect($days)->unique()->mapToDictionary(function ($day) use ($added, $mail) {
            $dayAdded = $added->get($day);

            $yesterday = Carbon::parse($day)->subDay()->format('Y-m-d');
            $lastMail = $mail->get($yesterday);
            /*while (is_null($lastMail)){
                $yesterday = Carbon::parse($yesterday ?? $day)->subDay()->format('Y-m-d');
                $lastMail = $mail->get($yesterday);
            }*/
            $isValid = is_numeric($dayAdded) && is_numeric($lastMail) && $lastMail > 0;
            $result = $isValid ? ($dayAdded / $lastMail) * 100 : null;

            return [$day => is_numeric($result) ? floor($result) : null];
        })->map(fn($v) => is_array($v) ? ($v[0] ?? 0) : $v);

    }

    public static function calculateConversion(Collection $mail, Collection $hired)
    {
        $days = array_merge(array_keys($mail->toArray()), array_keys($hired->toArray()));
        //$days = ;

        return collect($days)->unique()->mapToDictionary(function ($day) use ($hired, $mail) {
            $dayHired = $hired->get($day, 0);
            $totalMail = $mail->get($day,0);
            $isValid = is_numeric($dayHired) && is_numeric($totalMail) && $totalMail > 0;
            $result = $isValid ? ($dayHired / $totalMail) * 100 : null;

            return [$day => is_numeric($result) ? round($result, 5) : null];
        })->map(fn($v) => is_array($v) ? ($v[0] ?? 0) : $v);

    }

    public static function total(?\DateTimeInterface $from, ?\DateTimeInterface $to, Collection $staff): array
    {
        $hired = collect(self::hiredStats($from, $to, $staff));
        //$relativeHired = collect(self::relativeHiredStats($from, $to, $staff));
        $added = collect(self::addedStats($from, $to, $staff));
        $mail = collect(self::mailStats($from, $to, $staff));
        //$totalMail = collect(self::totalMailStats($from, $to, $staff));
        //dd(DB::getQueryLog());

        $days = DateService::getDays($from, $to ?? Carbon::now());

        $data['days'] = [];

        foreach ($days as $key => $day) {
            //$default = 0;
            /* if (Carbon::parse($day)->isWeekend()) {
                 continue;
             }*/
            $yesterday = Carbon::parse($day)->subDay();
            /*while ($yesterday->isWeekend()) {
                $yesterday->subDay();
            }*/
            $yesterday = $yesterday->format('Y-m-d');
            $data['days'][] = $day;
            $default = /*Carbon::parse($day)->isWeekend() ? null :*/0;

           /* $data['total_mails'] = $data['total_mails'] ?? [];
            $data['total_mails'][$day] = $totalMail->get($day, 0);

            $data['total_mails'][$day] += $data['total_mails'][$yesterday] ?? 0;*/

            foreach (['sent_1' => 1, 'sent_2' => 2/*, 'sent_3' => 3*/] as $key => $wave) {
                $value = $mail->has($day) ? collect($mail->get($day)) : collect([]);
                $values = $data[$key] ?? [];
                $values[$day] = (int)($value->where('wave', $wave)->first()['processed'] ?? $default);
                //$values[$day] = $values[$day] + ($values[$yesterday] ?? 0);
                $data[$key] = $values;
                $data['total'] = $data['total'] ?? [];
                $data['total'][$day] = $data['total'][$day] ?? 0;
                $data['total'][$day] += $values[$day];
            }
            $data['total'][$day] = $data['total'][$day] + ($data['total'][$yesterday] ?? 0);;

            $data['hired'] = $data['hired'] ?? [];

          /*  $data['relative_hired'] = $data['relative_hired'] ?? [];
            $value = $hired->has($day) ? collect($hired->get($day)[0] ?? []) : collect([]);
            $relativeValue = $relativeHired->has($day) ? collect($relativeHired->get($day)[0] ?? []) : collect([]);*/

            $data['hired'][$day] = $value->get('count', $default) + ($data['hired'][$yesterday] ?? 0);
            //$data['relative_hired'][$day] = $relativeValue->get('count', $default) + ($data['relative_hired'][$yesterday] ?? 0);
            // $data['hired'][$day] = $value->get('count', $default);

            $data['new'] = $data['new'] ?? [];
            $value = $added->has($day) ? collect($added->get($day)[0] ?? []) : collect([]);
            //$data['new'][$day] = $value->get('count', $default);
            $data['new'][$day] = $value->get('count', $default) + ($data['new'][$yesterday] ?? 0);
            $data['bounce'] = self::calculateBounce(collect($data['total']), collect($data['new']));
        }

       // $data['index'] = self::calculateConversion(collect($data['total_mails']), collect($data['hired']));
        $data['bounce'] = self::calculateConversion(collect($data['new']), collect($data['hired']))->map(fn($x) => is_numeric($x) && $x<15 ? $x : 0);;


        foreach (['bounce', 'days', 'hired', 'new', 'sent_1', 'sent_2', 'total', /*'index', 'total_bounce', 'total_conversion'*/] as $group) {
            foreach ($data[$group] as $date => $value) {
                if (Carbon::parse($date)->isWeekend()) {
                    unset($data[$group][$date]);
                }
            }
        }

        foreach ($data['days'] as $key => $date) {
            if (Carbon::parse($date)->isWeekend()) {
                unset($data['days'][$key]);
            }
        }
        return $data;
    }
}
