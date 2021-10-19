<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Letter\LetterStoreRequest;
use App\Http\Requests\Concrete\Letter\LetterUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\Base\ModelResource;
use App\Http\Resources\LetterResource;
use App\Models\Letter;
use App\Services\Concrete\Letter\LetterService;
use App\Services\Concrete\Letter\UserLetterService;
use App\Services\Contracts\ResourceServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class LetterController extends Controller
{
    private ResourceServiceInterface $service;

    public function __construct(ResourceServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->get()->items();

        return new ListResource($data);
    }

    public function store(LetterStoreRequest $r)
    {
        $letter = $this->service->make($r);
        $this->service->store($letter);

        return new LetterResource($letter);
    }


    public function show(Letter $letter)
    {
        $letter = $this->service->show($letter);

        return new LetterResource($letter);
    }

    public function update(LetterUpdateRequest $r, Letter $letter)
    {
        $letter = $this->service->make($r, $letter);
        $this->service->update($letter);

        return new LetterResource($letter);
    }

    public function destroy(Letter $letter)
    {
        try {
            $this->service->destroy($letter);
            return new LetterResource($letter);
        } catch (\Exception $e) {
            return response($e->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function total()
    {
        $q = DB::table('letters');
        foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
            $q->selectRaw("SUM($client) as {$client}_total");
        }

        return new ModelResource($q->get());
    }
}
