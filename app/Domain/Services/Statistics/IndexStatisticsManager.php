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

class IndexStatisticsManager
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
    ): IndexStatisticsManager {
        $hired = GetDailyStatisticsService::hiredStats($from, $to, $staff);
        $relativeHired = GetDailyStatisticsService::relativeHiredStats($from, $to, $staff);
        $added = GetDailyStatisticsService::addedStats($from, $to, $staff);
        $mail = GetDailyStatisticsService::mailStats($from, $to, $staff);
        self::summarize($hired, $from, $to);
        self::summarize($relativeHired, $from, $to);
        self::summarize($added, $from, $to);
        self::summarize($mail, $from, $to);

        $this->calculations = collect([
            'days' => DateService::getDays($from, $to ?? Carbon::now()),
            'index' => self::calculateConversion($mail, $hired),
            'relative_index' => self::calculateConversion($mail, $relativeHired),
            'conversion' => self::calculateConversion($added, $hired)->map(fn($x) => $x < 100 ? $x : 0),
            'relative_conversion' => self::calculateConversion($added, $relativeHired)->map(fn($x) => $x < 100 ? $x : 0),
            'bounce' => self::calculateConversion($mail, $added)->map(fn($x) => is_null($x) ? $x : $x / 10),
        ]);

        return $this;
    }

    public function cutWeekends(): IndexStatisticsManager
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

    private function summarize(Collection $data,  ?\DateTimeInterface $from, ?\DateTimeInterface $to)
    {
        $from = $from ?? Carbon::now();
        $to = $to ?? Carbon::now();

        $days = DateService::getDays($from, $to);

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
}
