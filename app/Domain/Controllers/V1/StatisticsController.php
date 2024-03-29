<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Models\Employee;
use App\Domain\Models\User;
use App\Domain\Requests\Concrete\Shared\DateRangeRequest;
use App\Domain\Services\Statistics\DailyStatisticsManager;
use App\Domain\Services\Statistics\IndexStatisticsManager;
use App\Domain\Services\Statistics\DailyStatisticsService;
use App\Domain\Services\Statistics\TodayStatisticsService;
use App\Domain\Services\Statistics\TotalStatisticsService;
use App\Source\Control\Controller;
use App\Domain\Services\User\GetUserService;
use App\Domain\Services\User\StoreUserService;
use App\Source\Resources\ModelResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    private StoreUserService $storeService;
    private GetUserService $getService;
    private TotalStatisticsService $statisticsService;
    private IndexStatisticsManager $statisticsManager;
    private DailyStatisticsManager $dailyStatisticsManager;

    public function __construct(
        StoreUserService $storeService,
        GetUserService $getService,
        TotalStatisticsService $statisticsService,
        IndexStatisticsManager $statisticsManager,
        DailyStatisticsManager $dailyStatisticsManager
    ) {
        $this->storeService = $storeService;
        $this->getService = $getService;
        $this->statisticsService = $statisticsService;
        $this->statisticsManager = $statisticsManager;
        $this->dailyStatisticsManager = $dailyStatisticsManager;
    }

    public function daily(DateRangeRequest $request)
    {
        $hrIds = $request->hrs ?? [];
        $to = is_null($request->to) ? null : Carbon::parse($request->to);
        $from = is_null($request->from) ? null : Carbon::parse($request->from);

        $managers = empty($hrIds) ? User::all() : User::whereIn('id', $hrIds)->get();
        //$data = $this->statisticsManager->calculate($from, $to, $managers)->cutWeekends()->getCalculations();
        //$data = DailyStatisticsService::total($from, $to, $managers);
        $data = $this->dailyStatisticsManager->calculate($from, $to, $managers)->cutWeekends()->getCalculations();

        return new ModelResource(['model' => $data]);
    }

    public function index(DateRangeRequest $request)
    {
        $hrIds = $request->hrs ?? [];
        $to = is_null($request->to) ? null : Carbon::parse($request->to);
        $from = is_null($request->from) ? null : Carbon::parse($request->from);

        $managers = empty($hrIds) ? User::all() : User::whereIn('id', $hrIds)->get();
        $data = $this->statisticsManager->calculate($from, $to, $managers)->cutWeekends()->getCalculations();

        return new ModelResource(['model' => $data]);
    }

    public function total(DateRangeRequest $request)
    {
        $to = is_null($request->total_to) ? null : Carbon::parse($request->total_to);
        $from = is_null($request->total_from) ? null : Carbon::parse($request->total_from);

        return new ModelResource(['model' => $this->statisticsService->get($from, $to)]);
    }

    public function today()
    {
        return new ModelResource([
            'model' => TodayStatisticsService::get(Carbon::now())
        ]);
    }
}
