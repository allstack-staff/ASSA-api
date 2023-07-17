<?php

namespace App\Http\Controllers\API;

use App\Authorization\SquadAuthorization;
use App\Http\Controllers\API\BaseController;
use App\Http\Filters\Squad\SquadFilter;
use App\Http\Requests\Squad\CreateSquadRequest;
use App\Http\Requests\Squad\UpdateSquadRequest;
use App\Http\Resources\Squad\SquadCollection;
use App\Http\Resources\Squad\SquadResource;
use App\Http\Resources\SquadUser\SquadUserResource;
use App\Services\SquadService;
use Illuminate\Http\Request;

class SquadController extends BaseController
{
    protected $squadService;

    public function __construct(SquadService $squadService)
    {
        $this->squadService = $squadService;
    }

    public function store(CreateSquadRequest $request)
    {
        SquadAuthorization::store($request->user()->id);

        $data = $this->squadService->create($request->validated(), $request->user());

        return $this->sendResponse(
            [
                "squad" => new SquadResource($data["squad"]),
                "squad_user" => new SquadUserResource($data["squad_user"])
            ],
            "",
            201
        );
    }

    public function update(UpdateSquadRequest $request, $id)
    {
        SquadAuthorization::update($request->user()->id, $id);

        $squad = $this->squadService->update($request->validated(), $id);

        return $this->sendResponse(new SquadResource($squad), "", 200);
    }

    public function getAll(Request $request)
    {
        SquadAuthorization::getAll($request->user()->id);

        $filterParams = SquadFilter::getFilter($request);

        return $this->sendResponse(new SquadCollection($this->squadService->getAll($filterParams)), "", 200);
    }

    public function getById(Request $request, $id)
    {
        SquadAuthorization::getById($request->user()->id, $id);

        return $this->sendResponse(new SquadResource($this->squadService->getById($id)), "", 200);
    }

    public function delete(Request $request, $id)
    {
        SquadAuthorization::deleteById($request->user()->id, $id);

        $this->sendResponse($this->squadService->delete($id), "", 200);
    }
}
