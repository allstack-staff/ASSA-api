<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\SquadUser\CreateSquadUserRequest;
use App\Http\Resources\SquadUser\SquadUserResource;
use App\Services\SquadUserService;

class SquadUserController extends BaseController
{
    protected $squadUserService;

    public function __construct(SquadUserService $squadUserService)
    {
        $this->squadUserService = $squadUserService;
    }

    public function store(CreateSquadUserRequest $request, $squad_id, $user_id)
    {
        $squad = $this->squadUserService->create($request->validated(), $squad_id, $user_id);

        return $this->sendResponse(new SquadUserResource($squad), "", 201);
    }
}
