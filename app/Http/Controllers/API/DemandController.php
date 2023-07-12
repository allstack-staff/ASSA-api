<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Demand\CreateDemandRequest;
use App\Http\Requests\Demand\UpdateDemandRequest;
use App\Http\Resources\Demand\DemandCollection;
use App\Http\Resources\Demand\DemandResource;
use App\Services\DemandService;
use Illuminate\Http\Request;

class DemandController extends BaseController
{
    protected $demandService;

    public function __construct(DemandService $demandService)
    {
        $this->demandService = $demandService;
    }

    public function store(CreateDemandRequest $request, $squad_id, $project_id)
    {
        $demand = $this->demandService->create($request->validated(), $squad_id, $project_id);

        return $this->sendResponse(new DemandResource($demand), "", 201);
    }

    public function update(UpdateDemandRequest $request, $squad_id, $project_id, $demand_id)
    {
        $demand = $this->demandService->update($request->validated(), $squad_id, $project_id, $demand_id);

        return $this->sendResponse(new DemandResource($demand), "", 200);
    }

    public function getAllByProject(Request $request, $squad_id, $project_id)
    {
        $demands = $this->demandService->getAllByProject($squad_id, $project_id);

        return $this->sendResponse(new DemandCollection($demands), "", 200);
    }

    public function getById(Request $request, $squad_id, $project_id, $demand_id)
    {
        $demand = $this->demandService->getById($squad_id, $project_id, $demand_id);

        return $this->sendResponse(new DemandResource($demand), "", 200);
    }

    public function delete(Request $request, $squad_id, $project_id, $demand_id)
    {
        $demand = $this->demandService->delete($squad_id, $project_id, $demand_id);

        return $this->sendResponse("", "", 200);
    }
}
