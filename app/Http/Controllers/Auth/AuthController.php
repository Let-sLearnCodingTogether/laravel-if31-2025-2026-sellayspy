<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        try {
            $validated = $request->safe()->all();
            $passwordHash = Hash::make($validated['password']);
            $validated['password'] = $passwordHash;
            $response = User::create($validated);

            if ($response) {
                return response()->json([
                    'message' => 'register berhasil',
                    'user' => $response
                ], 201);
            }
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data'  => null
            ], 500);
        }

    }

    public function login(LoginRequest $request) {
        try {
            $validated = $request->safe()->all();
            if(!Auth::attempt($validated)) {
                return response()->json([
                    'message' => 'email atau password salah',
                    'data'  => null
                ], 401);
            }

            $user = $request->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'login berhasil',
                'access_token' => $token,
                'user' => $user
            ], 200);
        } catch(Exception $e) {
           return response()->json([
                'message' => $e->getMessage(),
                'data'  => null
            ], 500);
        }

    }

    public function logout(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'logout berhasil',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data'  => null
            ], 500);
        }
    }
}
