<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword\UpdateRequest;
use App\Services\ResetPassword\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public function __construct(
        protected ResetPasswordService $service = new ResetPasswordService
    )
    {}

    public function checkLogin(Request $request)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>   $this->service->getLinkResetPassword($request->all())
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

       return response()->json($result, $result['status']);
    }

    public function updatePassword(User $user, UpdateRequest $request)
    {
        try {
            $result = [
                'status' => 200
                ,'data'  =>  $this->service->saveNewPassword($user, $request->validated())
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

       return response()->json($result, $result['status']);
    }
}