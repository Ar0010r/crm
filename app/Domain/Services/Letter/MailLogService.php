<?php

namespace App\Domain\Services\Letter;

use App\Domain\Models\Letter;
use App\Domain\Models\MailLog;

class MailLogService
{
    public static function process(Letter $letter, int $increase)
    {
        $badCase = floor(($letter->processed + $increase) / $letter->getTotal()) > floor($letter->processed / $letter->getTotal());
        $round = ($letter->processed + $increase) % $letter->getTotal() == 0;

        if ($badCase && !$round) {
            $nextWave = ($letter->processed + $increase) % $letter->getTotal();
            $thisWave = $increase - $nextWave;
            foreach ([$thisWave, $nextWave] as $wave){
               $wave > 0 && self::process($letter, $wave);
               $letter->processed += $wave;
            }
            return;
        }

        //dd($letter->processed % $letter->getTotal(), $letter->processed, $letter->getTotal());
        MailLog::create([
            'batch_id' => $letter->getKey(),
            'hr_id' => $letter->hr_id,
            'processed' => $increase,
            'wave' => floor(($letter->processed / $letter->getTotal())) + 1,
        ]);
    }
}
