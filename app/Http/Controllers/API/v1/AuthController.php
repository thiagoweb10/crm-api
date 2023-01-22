<?php

namespace App\Http\Controllers\API\v1;

use auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $loginService;
    
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        try {
            
            $credentials = $request->validated();
            $auth        = $this->loginService->execute($credentials);

            return response()->json($auth, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 200);
        }
    }

    public function me()
    {
        try {
            return response()->json(auth()->user(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 200);
        }
    }

    public function logout()
    {
        try {
            auth()->logout(true);
            return response()->json(['error' => false, 'message' => 'Logout Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 200);
        }
    }

    public function getValidToken()
    {
        try {
            JWTAuth::parseToken()->authenticate();

            return response()->json(['status' => 'valid'], 200);
            
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'], 401);
            }elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'], 401);
            }else {
                return response()->json(['status' => 'Authorization token not found'], 401);
            }
        }
    }
}
