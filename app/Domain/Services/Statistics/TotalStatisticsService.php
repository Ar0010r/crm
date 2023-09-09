<?php

namespace App\Domain\Services\Statistics;

use App\Domain\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class TotalStatisticsService
{
    private ?\DateTimeInterface $from = null;
    private ?\DateTimeInterface $to = null;

    public function get(?\DateTimeInterface $from, ?\DateTimeInterface $to): array
    {
        $this->to = $to;
        $this->from = $from;
        $new = $this->newStats();
        $hired = $this->hiredStats();
        $emails = $this->emailStats();
        $hrIds = array_merge(array_keys($new), array_keys($hired), array_keys($emails));
        $hrs = User::query()->whereIn('id', $hrIds)->get();
        $table = [];

        foreach ($hrs as $hr) {
            $hrHired = $hired[$hr->getKey()] ?? 0;
            $hrNew = $new[$hr->getKey()] ?? 0;
            $hrEmails = $emails[$hr->getKey()] ?? 0;
            $table[] = [
                'hr' => $hr->login,
                'hired' => $hrHired,
                'new' => $hrNew,
                'emails' => $hrEmails,
                'conversion' => round(($hrNew > 0 ? round($hrHired / $hrNew, 4) :  0) * 100, 2),
                'bounce' => round(($hrEmails > 0 ? round($hrNew / $hrEmails, 4) :  0) * 100, 2),
                'index' => round(($hrEmails > 0 ? round($hrHired / $hrEmails, 4) :  0) * 100, 2),
            ];
        }


        $totalEmails = array_sum($emails);
        $totalHired = array_sum($hired);
        $totalNew = array_sum($new);

        return [
            'hr' => $table,
            'total' => [
                'emails' => array_sum($emails),
                'bounce' => round(($totalEmails > 0 ? round($totalNew / $totalEmails, 4) :  0) * 100, 2),
                'conversion' => round(($totalNew > 0 ? round($totalHired / $totalNew, 4) :  0) * 100, 2),
                'index' => round(($totalEmails > 0 ? round($totalHired / $totalEmails, 4) :  0) * 100, 2),
                'hired' => $totalHired,
                'new' => $totalNew
            ]
        ];
    }

    private function emailStats()
    {
        $to = $this->to?->format('Y-m-d');
        $from = $this->from?->format('Y-m-d');
        return DB::table('letters')->selectRaw(
            'hr_id, SUM(google) AS total_google, ' .
            'SUM(outlook) AS total_outlook, ' .
            'SUM(other) AS total_other, ' .
            'SUM(yahoo) AS total_yahoo, ' .
            'SUM(google + outlook + other + yahoo) AS total')
            ->when(is_string($to), fn(Builder $v) => $v->where('received_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('received_at', '>=', $from))
            ->groupBy('hr_id')
            ->get()->mapToDictionary(fn($v) => [$v->hr_id => $v->total])
            ->map(fn($x) => (int)$x[0] ?? null)->toArray();
    }

    private function newStats()
    {
        $to = $this->to?->format('Y-m-d');
        $from = $this->from?->format('Y-m-d');

        return DB::table('employees')->selectRaw('COUNT(*) as count, hr_id')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            ->groupBy('hr_id')
            ->get()->mapToDictionary(fn($v) => [$v->hr_id => $v->count])
            ->map(fn($x) => $x[0] ?? null)->toArray();
    }

    private function hiredStats()
    {
        $to = $this->to?->format('Y-m-d');
        $from = $this->from?->format('Y-m-d');

        return DB::table('employees')->selectRaw('COUNT(*) as count, hr_id')
            ->when(is_string($to), fn(Builder $v) => $v->where('created_at', '<=', $to))
            ->when(is_string($from), fn(Builder $v) => $v->where('created_at', '>=', $from))
            ->whereNotNull('hired_at')
            ->groupBy('hr_id')
            ->get()->mapToDictionary(fn($v) => [$v->hr_id => $v->count])
            ->map(fn($x) => $x[0] ?? null)->toArray();
    }
}
