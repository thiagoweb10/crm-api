<?php
namespace App\Services\Auth;

use Exception;

class LoginService
{
    public function getAuthentication($credentials)
    {
        if (!auth()->attempt($credentials)){
            throw new Exception('Invalid Credentials', 401);
        }
        
        $nameToken = 'crm-app';
        $token = auth()->user()->createToken($nameToken);

        return [
            'token'         => $token->plainTextToken,
            'expired_at'    => $token->accessToken->expired_at,
            'user'          => auth()->user()
        ];
        

       
    }
}