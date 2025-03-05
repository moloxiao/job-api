<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {
                Log::error('Unauthorized ');
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (TokenExpiredException $e) {
            Log::error('AuthController 1 error: ' . $e->getMessage());
            return response()->json(['error' => 'Token expired'], 401);
        } catch (TokenInvalidException $e) {
            Log::error('AuthController 2 error: ' . $e->getMessage());
            return response()->json(['error' => 'Token invalid'], 401);
        } catch (\Exception $e) {
            Log::error('AuthController 3 error: ' . $e->getMessage());
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    }
}
