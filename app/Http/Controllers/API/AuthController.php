<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\CandidatureStatusNotification;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

    }

    public function registerClient(RegisterRequest $request)
    {
        $validated = $request->validated();
        $userInfo = $this->authService->register($validated, 'client');
        return response()->json([
            'success' => true,
            'message' => "BienVenue Client",
            'data' => $userInfo['user'],
            'token' => $userInfo['token']
        ], 201);
    }

    public function registerFreelance(RegisterRequest $request)
    {
        $validated = $request->validated();
        $userInfo = $this->authService->register($validated, 'freelance');
        return response()->json([
            'success' => true,
            'message' => "BienVenue Freelance",
            'data' => $userInfo['user'],
            'token' => $userInfo['token']
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        //$request->user();
        $userInfo = $this->authService->login($request, $validated);
        return response()->json([
            'success' => true,
            'message' => "Connexion avec success",
            'data' => $userInfo['user'],
            'token' => $userInfo['token']
            ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => "Deconnexion reusiie"
        ]);
    }

    public function user(Request $request){
        return response()->json([
            "success" => true,
            "message" => "Profile utilisateur",
            "data" => ["user" => $request->user(),
                "notification" => auth()->user()->notifications
                ]
        ]);
    }
}
