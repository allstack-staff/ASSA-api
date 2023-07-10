<?php

namespace App\Http\Filters\User;

use App\Http\Filters\FilterAbstract;
use Illuminate\Http\Request;

class UserFilter extends FilterAbstract
{
    public static function getFilter(Request $request): array
    {
        $filterParams = array();

        $searchParams = [
            "name" => $request->query('name', '')
        ];

        $perPage = $request->query('per_page', 5);
        $page = $request->query('page', 1);

        $filterParams = [
            "searchParams" => $searchParams,
            "perPage" => $perPage,
            "page" => $page
        ];

        return $filterParams;
    }
}
