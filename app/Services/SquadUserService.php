<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\SquadRepository;
use App\Repositories\SquadUserRepository;
use App\Repositories\UserRepository;
use App\Traits\Squad\SquadFinder;
use App\Traits\Squad\SquadUserFinder;
use App\Traits\User\UserFinder;

class SquadUserService
{
    use SquadFinder;
    use UserFinder;
    use SquadUserFinder;

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
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingUser = $this->findUserOrFail($user_id);

        if ($this->squadUserRepository->getBySquadAndUser($squad_id, $user_id)) {
            throw new DomainException(["User is already in the squad."], 409);
        }

        $data["squad_id"] = $squad_id;
        $data["user_id"] = $user_id;

        return $this->squadUserRepository->create($data);
    }

    public function getUsersBySquad(int $squad_id)
    {
        return $this->squadUserRepository->getUsersBySquad($squad_id);
    }

    public function getSquadUsersBySquad(int $squad_id)
    {
        return $this->squadUserRepository->getSquadUsersBySquad($squad_id);
    }

    public function update(array $data, int $squad_id, int $user_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingUser = $this->findUserOrFail($user_id);

        $existingSquadUser = $this->findSquadUserOrFailBySquadAndUser($squad_id, $user_id);

        $data["squad_id"] = $squad_id;
        $data["user_id"] = $user_id;

        return $this->squadUserRepository->update($existingSquadUser->id, $data);
    }

    public function deleteUserFromSquad(int $squad_id, int $user_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingUser = $this->findUserOrFail($user_id);

        $existingSquadUser = $this->findSquadUserOrFailBySquadAndUser($squad_id, $user_id);

        return $this->squadUserRepository->delete($existingSquadUser->id);
    }

    public function getBySquadAndUser(int $squad_id, int $user_id)
    {
        $existingSquad = $this->findSquadOrFail($squad_id);

        $existingUser = $this->findUserOrFail($user_id);

        $existingSquadUser = $this->findSquadUserOrFailBySquadAndUser($squad_id, $user_id);
        
        return $this->squadUserRepository->getBySquadAndUser($squad_id, $user_id);
    }
}
