<?php

namespace App\Services;

use App\Repositories\DemandRepository;
use App\Traits\Demand\DemandFinder;
use App\Traits\Project\ProjectFinder;
use App\Traits\Squad\SquadFinder;

class DemandService
{
    use ProjectFinder;
    use SquadFinder;
    use DemandFinder;

    private $demandRepository;

    public function __construct(
        DemandRepository $demandRepository
    ) {
        $this->demandRepository = $demandRepository;
    }

    public function create(array $data, int $squad_id, int $project_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        $data["squad_id"] = $squad_id;
        $data["project_id"] = $project_id;

        return $this->demandRepository->create($data);
    }

    public function update(array $data, int $squad_id, int $project_id, int $demand_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        $data["squad_id"] = $squad_id;
        $data["project_id"] = $project_id;

        return $this->demandRepository->update($demand_id, $data);
    }

    public function getAllByProject(int $squad_id, int $project_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        return $this->demandRepository->getAllByProject($project_id);
    }

    public function getById(int $squad_id, int $project_id, int $demand_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        $existingDemand = $this->findDemandOrFail($demand_id);

        return $existingDemand;
    }

    public function delete(int $squad_id, int $project_id, int $demand_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingProject = $this->findProjectOrFail($project_id);

        $existingDemand = $this->findDemandOrFail($demand_id);

        return $this->demandRepository->delete($demand_id);
    }
}
