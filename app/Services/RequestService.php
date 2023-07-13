<?php

namespace App\Services;

use App\Repositories\RequestRepository;
use App\Traits\Demand\DemandFinder;
use App\Traits\Project\ProjectFinder;
use App\Traits\Request\RequestFinder;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;

class RequestService
{
    use ProjectFinder;
    use SquadFinder;
    use DemandFinder;
    use SquadUserFinder;
    use RequestFinder;

    private $requestRepository;

    public function __construct(
        RequestRepository $requestRepository
    ) {
        $this->requestRepository = $requestRepository;
    }

    public function create(array $data)
    {
        $existingProject = $this->findProjectOrFail($data["project_id"]);

        $existingSquad = $this->findSquadOrFail($data["squad_id"]);

        $existingSquadUser = $this->findSquadUserOrFailBySquadAndUser($data["user_id"], $data["project_id"]);

        $data["status"] = "Under review";
        $data["project_id"] = $data["project_id"];
        $data["squad_origin_id"] = $data["squad_id"];
        $data["squad_origin_user_id"] = $existingSquadUser->id;

        return $this->requestRepository->create($data);
    }

    public function getAllBySquad(int $squad_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        return $this->requestRepository->getAllBySquad($squad_id);
    }

    public function getAllByProject(int $squad_id, int $project_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        return $this->requestRepository->getAllByProject($project_id);
    }

    public function getById(int $squad_id, int $project_id, int $request_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findDemandOrFail($project_id);

        $existingRequest = $this->findRequestOrFail($request_id);

        return $existingRequest;
    }
}
