<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Squad\CreateSquadRequest;
use App\Http\Requests\Squad\UpdateSquadRequest;
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
        $squad = $this->squadService->create($request->validated());

        return $this->sendResponse(new SquadResource($squad), "", 201);
    }

    public function update(UpdateSquadRequest $request, $id)
    {
        $squad = $this->squadService->update($request->validated(), $id);

        return $this->sendResponse(new SquadResource($squad), "", 200);
    }
}
