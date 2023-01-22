<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserProfile(Request $request)
    {
        $sProfile = (!is_null($request->query('profile'))) ? $request->query('profile') : 'Developer';

        $users = User::whereHas("roles", function($q) use($sProfile) {
            $q->where("name", $sProfile);
        })->get();
        
        return response()->json($users, 200);
    }
}
