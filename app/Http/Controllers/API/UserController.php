<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        return $this->sendResponse(new UserResource($user), "", 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->update($request->validated(), $id);

        return $this->sendResponse(new UserResource($user), "", 200);
    }

    public function getAll(Request $request)
    {
        return $this->sendResponse(new UserCollection($this->userService->getAll()), "", 200);
    }

    public function getById(Request $request, $id)
    {
        return $this->sendResponse(new UserResource($this->userService->getById($id)), "", 200);
    }
}
