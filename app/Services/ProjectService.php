<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Traits\Project\ProjectFinder;
use App\Traits\Squad\SquadFinder;

class ProjectService
{
    use ProjectFinder;
    use SquadFinder;

    private $projectRepository;

    public function __construct(
        ProjectRepository $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }

    public function create(array $data, int $squad_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $data["squad_id"] = $squad_id;

        return $this->projectRepository->create($data);
    }

    public function update(array $data, int $squad_id, int $project_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        $data["squad_id"] = $squad_id;
        $data["project_id"] = $project_id;

        return $this->projectRepository->update($project_id, $data);
    }

    public function getAllBySquad(int $squad_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        return $this->projectRepository->getAllBySquad($squad_id);
    }
}
