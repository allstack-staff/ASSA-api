<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Services\ProjectService;

class ProjectController extends BaseController
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function store(CreateProjectRequest $request, $squad_id)
    {
        $project = $this->projectService->create($request->validated(), $squad_id);

        return $this->sendResponse(new ProjectResource($project), "", 201);
    }

}
