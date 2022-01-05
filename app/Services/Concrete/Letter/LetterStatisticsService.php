<?php

namespace App\Services\Concrete\Letter;



use App\Models\User;
use Illuminate\Support\Facades\DB;

class LetterStatisticsService
{
    private ScopeLetterService $scopeService;
    public function __construct(ScopeLetterService $scopeService)
    {
        $this->scopeService = $scopeService;
    }

    public function calculate(User $user = null): array
    {
        $user = $user ?? auth()->user();
        $letters = $this->scopeService->getScope($user)->with('hr')->get()->toArray();
        $letters = collect($letters)->map(fn($item) => collect($item));
        return $letters->pluck('hr_id')->unique()->map(function ($hr_id) use($letters) {
            $scope = $letters->where('hr_id', $hr_id);
            return [
                'hr' => $scope->first()->get('hr'),
                'google_total' => $scope->sum('google'),
                'outlook_total' => $scope->sum('outlook'),
                'yahoo_total' => $scope->sum('yahoo'),
                'other_total' => $scope->sum('other'),
            ];
        })->toArray();
    }

}
