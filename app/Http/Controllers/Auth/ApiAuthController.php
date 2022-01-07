<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRegistrationRequest $request)
    {
        if (!$this->userService->createUser($request)) {
            return response(["message" => "Unable to create user."], 400);
        }
        return response(["message" => "User created successfully."], 201);
    }

    public function login(UserLoginRequest $request)
    {
        $user = $this->userService->findByEmailOrPhone($request->email);

        if (!$user) {
            return response(["message" =>'User does not exist'], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response(["message" => "Password mismatch"], 400);
        }

        return new UserResource($user);
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response(['message' => 'You have been successfully logged out!'], 200);
    }
}
