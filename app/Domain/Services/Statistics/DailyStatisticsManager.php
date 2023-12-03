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

class DailyStatisticsManager
{
    private Collection $calculations;

    public function __construct()
    {
        $this->calculations = collect([]);
    }

    public function calculate(
        ?\DateTimeInterface $from,
        ?\DateTimeInterface $to,
        Collection $staff
    ): DailyStatisticsManager {
        $hired = GetDailyStatisticsService::hiredStats($from, $to, $staff);
        $added = GetDailyStatisticsService::addedStats($from, $to, $staff);
        $mail = GetDailyStatisticsService::sendingStats($from, $to, $staff);
        $relativeHired = GetDailyStatisticsService::relativeHiredStats($from, $to, $staff);
        $waves = $this->getWaves($mail);
        $totalMails = collect($waves['total']);

        $this->calculations = collect([
            ...$waves,
            'new' => $added,
            'hired' => $hired,
            'relative_hired' => $relativeHired,
            'days' => DateService::getDays($from, $to ?? Carbon::now()),
            'bounce' => $this->calculateConversion($totalMails, $added),
        ]);

        return $this;
    }

    public function cutWeekends(): DailyStatisticsManager
    {
        foreach ($this->calculations->keys() as $metric) {
            foreach ($this->calculations[$metric] as $date => $value) {
                if (Carbon::parse($date)->isWeekend()) {
                    unset($this->calculations[$metric][$date]);
                }
            }
        }

        return $this;
    }

    private function summarize(Collection $data)
    {
        $from = $data->keys()->min();
        $to = $data->keys()->max();
        $days = DateService::getDays(Carbon::parse($from), Carbon::parse($to));

        foreach ($days as $day) {
            $yesterday = Carbon::parse($day)->subDay()->format('Y-m-d');
            $yesterdayValue = $data->get($yesterday, 0);
            $value = $data->get($day, 0);
            $data[$day] = $value + $yesterdayValue;
        }

        return $data;
    }

    public function calculateConversion(Collection $mail, Collection $hired): Collection
    {
        $days = collect([...$mail->keys(), ...$hired->keys()])->unique();
        $from = Carbon::parse($days->min());
        $to = Carbon::parse($days->max());
        $days = DateService::getDays($from, $to);
        $data = [];
        foreach ($days as $day) {
            $dayHired = $hired->get($day, 0);
            $totalMail = $mail->get($day, 0);
            $isValid = is_numeric($dayHired) && is_numeric($totalMail) && $totalMail > 0;
            $result = $isValid ? ($dayHired / $totalMail) * 100 : null;

            $data[$day] = (is_numeric($result) && $result > 0) ? round($result, 5) : null;
        }

        return collect($data);
    }


    public function getCalculations(): Collection
    {
        return $this->calculations;
    }

    public function getWaves(Collection $mailStats, $default = 0): Collection
    {
        $days = $mailStats->keys()->unique();
        $data = ['total' => [], 'sent_1' => [], 'sent_2' => []];

        foreach ($days as $key => $day) {
            foreach (['sent_1' => 1, 'sent_2' => 2] as $key => $wave) {
                $value = $mailStats->has($day) ? collect($mailStats->get($day)) : collect([]);
                $values[$day] = (int)($value->where('wave', $wave)->first()['processed'] ?? $default);
                //$values[$day] = $values[$day] + ($values[$yesterday] ?? 0);
                $data[$key] = $values;
                $data['total'][$day] = $data['total'][$day] ?? 0;
                $data['total'][$day] += $values[$day];
            }
        }

        return  collect($data);
    }
}
