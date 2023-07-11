<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use UserFinder;

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
        $existingUser = $this->findUserOrFail($id);

        $existingUserByEmail = $this->userRepository->getByEmail($data['email']);
        if ($existingUserByEmail && $existingUserByEmail->id != $id) {
            throw new DomainException(['E-mail is already in use.'], 409);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->update($id, $data);
    }

    public function getAll(array $filterParams = [])
    {
        return $this->userRepository->getAll($filterParams);
    }

    public function getById(int $id)
    {
        $existingUser = $this->findUserOrFail($id);

        return $existingUser;
    }

    public function delete(int $id)
    {
        $existingUser = $this->findUserOrFail($id);
        
        return $this->userRepository->delete($id);
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->getByEmail($email);
        if ($user == NULL) {
            throw new DomainException(["Incorrect login or password."], 401);
        }

        if (!password_verify($password, $user->password)) {
            throw new DomainException(["Incorrect login or password."], 401);
        }

        return $user->createToken('mobile', ['role:user'])->plainTextToken;
    }
}
