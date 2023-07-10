<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function getAll(array $filterParams = [])
    {
        $query = $this->model->query();

        $perPage = 5;
        $page = 1;

        if (isset($filterParams['searchParams']['name']) && !empty($filterParams['searchParams']['name'])) {
            $name = $filterParams['searchParams']['name'];
            $query->where('name', 'LIKE', "%$name%");
        }

        $this->setPaginationParameters($filterParams, $perPage, $page);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
