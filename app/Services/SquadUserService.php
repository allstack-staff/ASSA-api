<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\SquadRepository;
use App\Repositories\SquadUserRepository;
use App\Repositories\UserRepository;

class SquadUserService
{
    private $squadUserRepository;
    private $squadRepository;
    private $userRepository;

    public function __construct(
        SquadUserRepository $squadUserRepository,
        SquadRepository $squadRepository,
        UserRepository $userRepository
    ) {
        $this->squadUserRepository = $squadUserRepository;
        $this->squadRepository = $squadRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data, int $squad_id, int $user_id)
    {
        $existingSquad = $this->squadRepository->getById($squad_id);
        if (!$existingSquad) {
            throw new DomainException(["Squad not found."], 404);
        }

        $existingUser = $this->userRepository->getById($user_id);
        if (!$existingUser) {
            throw new DomainException(["User not found."], 404);
        }

        if ($this->squadUserRepository->getBySquadAndUser($squad_id, $user_id)) {
            throw new DomainException(["User is already in the squad."], 409);
        }

        $data["squad_id"] = $squad_id;
        $data["user_id"] = $user_id;

        return $this->squadUserRepository->create($data);
    }
}
