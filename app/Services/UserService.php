<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $existingUser = $this->userRepository->getByEmail($data['email']);
        if ($existingUser) {
            throw new DomainException(['E-mail is already in use'], 409);
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        return $user;
    }

    public function update(array $data, int $id)
    {
        $existingUser = $this->userRepository->getById($id);
        if (!$existingUser) {
            throw new DomainException(['User not found'], 404);
        }

        $existingUserByEmail = $this->userRepository->getByEmail($data['email']);
        if ($existingUserByEmail && $existingUserByEmail->id != $id) {
            throw new DomainException(['E-mail is already in use.'], 409);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->update($id, $data);
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id)
    {
        $existingUser = $this->userRepository->getById($id);
        if (!$existingUser) {
            throw new DomainException(['User not found.'], 404);
        }

        return $existingUser;
    }

    public function delete(int $id)
    {
        $existingUser = $this->userRepository->getById($id);
        if (!$existingUser) {
            throw new DomainException(['User not found.'], 404);
        }
        
        return $this->userRepository->delete($id);
    }
}
