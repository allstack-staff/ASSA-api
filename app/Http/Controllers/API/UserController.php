<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        $userArray = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "photo" => $request->photo,
            "role" => $request->role
        ];

        $user = $this->userService->create($userArray);

        return $this->sendResponse($user, "", 201);
    }
}
