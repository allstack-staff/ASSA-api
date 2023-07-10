<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Squad\CreateSquadRequest;
use App\Http\Resources\Squad\SquadResource;
use App\Services\SquadService;

class SquadController extends BaseController
{
    protected $squadService;

    public function __construct(SquadService $squadService)
    {
        $this->squadService = $squadService;
    }

    public function store(CreateSquadRequest $request)
    {
        $dquad = $this->squadService->create($request->validated());

        return $this->sendResponse(new SquadResource($dquad), "", 201);
    }
}
