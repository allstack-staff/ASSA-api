<?php

namespace App\Http\Controllers\API;

use App\Authorization\UserAuthorization;
use App\Http\Controllers\API\BaseController;
use App\Http\Filters\User\UserFilter;
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
        if ($request->user()->isStandard()) {
            UserAuthorization::store($request->user()->id);
        }

        $user = $this->userService->create($request->validated());

        return $this->sendResponse(new UserResource($user), "", 201);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $this->userService->update($request->validated(), $request->user()->id);

        return $this->sendResponse(new UserResource($user), "", 200);
    }

    public function getAll(Request $request)
    {
        if ($request->user()->isStandard()) {
            UserAuthorization::getAll($request->user()->id);
        }

        $filterParams = UserFilter::getFilter($request);

        return $this->sendResponse(new UserCollection($this->userService->getAll($filterParams)), "", 200);
    }

    public function getById(Request $request, $id)
    {
        return $this->sendResponse(new UserResource($this->userService->getById($id)), "", 200);
    }

    public function delete(Request $request)
    {
        $this->userService->delete($request->user()->id);

        return $this->sendResponse("", "", 200);
    }

    public function login(Request $request)
    {
        return $this->sendResponse($this->userService->login($request->email, $request->password), "", 200);
    }

    public function me(Request $request)
    {
        return $this->sendResponse($request->user(), "", 200);
    }
}
