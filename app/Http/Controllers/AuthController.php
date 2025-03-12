<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private UserRepository $userRepository, private ResponseService $responseService) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

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

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // logout the user
        Auth::user()->tokens()->delete();

        return $this->responseService->success(null, __('auth.loged_out'));
    }
}
