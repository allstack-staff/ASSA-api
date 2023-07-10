<?php

namespace App\Services;

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

}
