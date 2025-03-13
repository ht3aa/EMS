<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Interfaces\ControllerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements ControllerInterface
{
    public function __construct(private UserRepository $userRepository, private ResponseService $responseService) {}

    public function index()
    {
        return $this->responseService->error(__('auth.unathorized'), 401);
    }

    public function show(Request $request)
    {

        // check if user exists
        $user = $this->userRepository->findByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => __('auth.failed'),
            ], 401);
        }

        // create token
        $accessToken = $user->createToken('accessToken')->plainTextToken;
        $refreshToken = $user->createToken('refreshToken')->plainTextToken;

        // return the created tokens
        return $this->responseService->success([
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
        ], __('auth.loged_in'));
    }

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        // logout the user
        Auth::user()->tokens()->delete();

        return $this->responseService->success(null, __('auth.loged_out'));
    }

    public function store(Request $request)
    {
        // check if user already exists
        if ($this->userRepository->findByEmail($request->email)) {
            return response()->json([
                'message' => __('user.already_exists'),
            ], 400);
        }

        // create the user
        $user = $this->userRepository->create($request->all());

        // return the created user
        return $this->responseService->created($user, __('user.created'), 201);
    }
}
