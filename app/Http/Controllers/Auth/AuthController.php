<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(LoginRequest $request) {
        try {
            $validated = $request->safe()->all();
            $passwordHash = Hash::make($validated['password']);
            $validated['password'] = $passwordHash;
            $response = User::create($validated);

            if ($response) {
                return response()->json([
                    'message' => 'register berhasil',
                    'user' => $response
                ]);
            }
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    public function login(RegisterRequest $request) {
        try {
            $validated = $request->safe()->all();
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    public function logout() {

    }
}
