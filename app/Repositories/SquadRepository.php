<?php

namespace App\Repositories;

use App\Models\Squad;

class SquadRepository extends AbstractRepository
{
    public function __construct(Squad $model)
    {
        $this->model = $model;
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
