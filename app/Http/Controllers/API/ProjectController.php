<?php

namespace App\Http\Controllers\API;

use App\Authorization\ProjectAuthorization;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\Project\ProjectCollection;
use App\Http\Resources\Project\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function store(CreateProjectRequest $request, $squad_id)
    {
        ProjectAuthorization::store($request->user()->id, $squad_id);

        $project = $this->projectService->create($request->validated(), $squad_id);

        return $this->sendResponse(new ProjectResource($project), "", 201);
    }

    public function update(UpdateProjectRequest $request, $squad_id, $project_id)
    {
        ProjectAuthorization::update($request->user()->id, $squad_id, $project_id);

        $project = $this->projectService->update($request->validated(), $squad_id, $project_id);

        return $this->sendResponse(new ProjectResource($project), "", 200);
    }

    public function getAllBySquad(Request $request, $squad_id)
    {
        $projects = $this->projectService->getAllBySquad($squad_id);

        return $this->sendResponse(new ProjectCollection($projects), "", 200);
    }

    public function getById(Request $request, $squad_id, $project_id)
    {
        $project = $this->projectService->getById($squad_id, $project_id);

        return $this->sendResponse(new ProjectResource($project), "", 200);
    }

    public function delete(Request $request, $squad_id, $project_id)
    {
        ProjectAuthorization::deleteById($request->user()->id, $squad_id, $project_id);

        $project = $this->projectService->delete($squad_id, $project_id);

        return $this->sendResponse("", "", 200);
    }
}
