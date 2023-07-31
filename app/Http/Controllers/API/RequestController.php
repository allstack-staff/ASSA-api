<?php

namespace App\Http\Controllers\API;

use App\Authorization\RequestAuthorization;
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
        $requestArray = $request->validated();
        $requestArray["user_id"] = $request->user()->id;

        if ($request->user()->isStandard()) {
            RequestAuthorization::store($request->user()->id, $requestArray["squad_id"], $requestArray["project_id"]);
        }

        $requestCreated = $this->requestService->create($requestArray);

        return $this->sendResponse(new RequestResource($requestCreated), "", 201);
    }

    public function getAllByProject(Request $request, $squad_id, $project_id)
    {
        if ($request->user()->isStandard()) {
            RequestAuthorization::getAllByProject($request->user()->id, $squad_id, $project_id);
        }

        $requests = $this->requestService->getAllByProject($squad_id, $project_id);

        return $this->sendResponse(new RequestCollection($requests), "", 200);
    }

    public function getById(Request $request, $squad_id, $project_id, $request_id)
    {
        if ($request->user()->isStandard()) {
            RequestAuthorization::getById($request->user()->id, $squad_id, $project_id);
        }

        $resquest = $this->requestService->getById($squad_id, $project_id, $request_id);

        return $this->sendResponse(new RequestResource($resquest), "", 200);
    }
}
