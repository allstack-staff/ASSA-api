<?php

namespace App\Services;

use App\Repositories\SquadRepository;
use App\Traits\Squad\SquadFinder;

class SquadService
{
    use SquadFinder;

    private $squadRepository;

    public function __construct(SquadRepository $squadRepository)
    {
        $this->squadRepository = $squadRepository;
    }

    public function create(array $data)
    {
        return $this->squadRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        $existingSquad = $this->findSquadOrFail($id);

        return $this->squadRepository->update($id, $data);
    }

    public function getAll(array $filterParams = [])
    {
        return $this->squadRepository->getAll($filterParams);
    }

    public function getById(int $id)
    {
        $existingSquad = $this->findSquadOrFail($id);

        return $existingSquad;
    }

    public function delete(int $id)
    {
        $existingSquad = $this->findSquadOrFail($id);
        
        return $this->squadRepository->delete($id);
    }
}
