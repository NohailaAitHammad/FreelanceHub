<?php

namespace App\Services;

use App\Models\Freelance;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register( array $data,string $role)
    {
        if($role === 'client') {
            $data['role_id'] = 8;
            $user = User::create($data);
            $token = $user->createToken('my_app_token')->plainTextToken;
            $client = Client::create(['user_id' => $user->id]);

        }else if($role === 'freelance'){
           $data['role_id'] = 9;
           $user = User::create($data);
           $token = $user->createToken('my_app_token')->plainTextToken;
           $user->load('freelance');
           $freelance = Freelance::create(['user_id' => $user->id]);

        }else {
            return response()->json([
                'success' => false,
                'message' => "Ce role n'existe pas dans l'application",
            ], 422);
        }

        return [
            'user' => $user,
            'token' => $token
        ];

    }

    public function login($request, $data)
    {
        if(Auth::attempt($data)){
            if($request->user()->role->role === "client" ){
                $client = $request->user();
                $token  = $client->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $client,
                    'token' => $token
                ];
            }else if($request->user()->role->role === "freelance" ){
                $freelance = $request->user();
                $token  = $freelance->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $freelance,
                    'token' => $token
                ];
            }else {
                $admin = $request->user();
                $token  = $admin->createToken('my_app_token')->plainTextToken;
                return [
                    'user' => $admin,
                    'token' => $token
                ];
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects',
            ], 401);

        }

    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
