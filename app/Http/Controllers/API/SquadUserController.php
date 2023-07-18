<?php

namespace App\Http\Controllers\API;

use App\Authorization\SquadUserAuthorization;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\SquadUser\CreateSquadUserRequest;
use App\Http\Requests\SquadUser\UpdateSquadUserRequest;
use App\Http\Resources\SquadUser\SquadUserCollection;
use App\Http\Resources\SquadUser\SquadUserResource;
use App\Services\SquadUserService;
use Illuminate\Http\Request;

class SquadUserController extends BaseController
{
    protected $squadUserService;

    public function __construct(SquadUserService $squadUserService)
    {
        $this->squadUserService = $squadUserService;
    }

    public function store(CreateSquadUserRequest $request, $squad_id, $user_id)
    {
        SquadUserAuthorization::store($request->user()->id, $squad_id);

        $squad = $this->squadUserService->create($request->validated(), $squad_id, $user_id);

        return $this->sendResponse(new SquadUserResource($squad), "", 201);
    }

    public function getUsersBySquad(Request $request, $squad_id)
    {
        SquadUserAuthorization::getUsersBySquad($request->user()->id, $squad_id);

        return $this->sendResponse(new SquadUserCollection($this->squadUserService->getSquadUsersBySquad($squad_id)), "", 200);
    }

    public function getBySquadAndUser(Request $request, $squad_id, $user_id)
    {
        SquadUserAuthorization::getBySquadAndUser($request->user()->id, $squad_id);

        return $this->sendResponse(new SquadUserResource($this->squadUserService->getBySquadAndUser($squad_id, $user_id)), "", 200);
    }

    public function update(UpdateSquadUserRequest $request, $squad_id, $user_id)
    {
        SquadUserAuthorization::update($request->user()->id, $squad_id);

        return $this->sendResponse(new SquadUserResource($this->squadUserService->update($request->validated(), $squad_id, $user_id)), "", 200);
    }

    public function deleteUserFromSquad(Request $request, $squad_id, $user_id)
    {
        SquadUserAuthorization::delete($request->user()->id, $squad_id, $user_id);

        $this->squadUserService->deleteUserFromSquad($squad_id, $user_id);

        return $this->sendResponse("", "", 200);
    }
}
