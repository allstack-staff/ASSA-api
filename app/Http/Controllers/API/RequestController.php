<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Request\CreateRequestRequest;
use App\Http\Resources\Request\RequestCollection;
use App\Http\Resources\Request\RequestResource;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends BaseController
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function store(CreateRequestRequest $request)
    {
        $request = $this->requestService->create($request->validated());

        return $this->sendResponse(new RequestResource($request), "", 201);
    }

    public function getBySquad(Request $request, $squad_id)
    {
        $requests = $this->requestService->getAllBySquad($squad_id);

        return $this->sendResponse(new RequestCollection($requests), "", 200);
    }

    public function getAllByProject(Request $request, $squad_id, $project_id)
    {
        $requests = $this->requestService->getAllByProject($squad_id, $project_id);

        return $this->sendResponse(new RequestCollection($requests), "", 200);
    }

    public function getById(Request $request, $squad_id, $project_id, $request_id)
    {
        $resquest = $this->requestService->getById($squad_id, $project_id, $request_id);

        return $this->sendResponse(new RequestResource($resquest), "", 200);
    }
}
