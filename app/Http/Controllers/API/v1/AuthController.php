<?php

namespace App\Http\Controllers\API\v1;

use auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;

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

            $result = [
                'status' => 200
                ,'data'  =>  $this->loginService->getAuthentication($credentials)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
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
       
    }
}
