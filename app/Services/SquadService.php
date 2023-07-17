<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SquadRepository;
use App\Traits\Squad\SquadFinder;

class SquadService
{
    use SquadFinder;

    private $squadRepository;
    private $squadUserService;

    public function __construct(SquadRepository $squadRepository, SquadUserService $squadUserService)
    {
        $this->squadRepository = $squadRepository;
        $this->squadUserService = $squadUserService;
    }

    public function create(array $data, User $user)
    {
        $squad = $this->squadRepository->create($data);

        $squadUser = $this->squadUserService->create(
            ["role" => "Coordinator"],
            $squad->id,
            $user->id
        );

        return ["squad" => $squad, "squad_user" => $squadUser];
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
