<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\SquadRepository;

class SquadService
{
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
        $existingSquad = $this->squadRepository->getById($id);
        if (!$existingSquad) {
            throw new DomainException(['Squad not found'], 404);
        }

        return $this->squadRepository->update($id, $data);
    }

}
