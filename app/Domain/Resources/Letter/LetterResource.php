<?php

namespace App\Domain\Resources\Letter;

use App\Source\Resources\ModelResource;

class LetterResource extends ModelResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'hr_id' => $this->hr_id,
            'company_id' => $this->company_id,
            'google' => (int)$this->google,
            'outlook' => (int)$this->outlook,
            'yahoo' => (int)$this->yahoo,
            'other' => (int)$this->other,
            'received_at' => $this->received_at,
            'processed' => (int)$this->processed,

            'hr' => $this->hr,
            'company' => $this->company,
            'total' => $this->total()
        ];
    }

    private function total(): int
    {
        return (int)$this->google + (int)$this->outlook + (int)$this->yahoo + (int)$this->other;
    }
}
