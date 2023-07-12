<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Traits\Squad\SquadFinder;

class ProjectService
{
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
}
