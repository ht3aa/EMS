<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

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

        return $this->authService->store($request);
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

        return $this->authService->show($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->authService->destroy($id);
    }
}
