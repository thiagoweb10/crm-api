<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\API\v1\DemandController;
use App\Http\Controllers\API\v1\SystemController;
use App\Http\Controllers\API\v1\RequestController;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;
use App\Http\Controllers\API\v1\PriorityController;
use App\Http\Controllers\API\v1\DepartmentController;
use App\Http\Controllers\API\v1\ResetPasswordController;

    Route::prefix('v1')->group(function(){
        
        Route::post('login', [AuthController::class, 'login']);

        Route::post('/reset-password', [ResetPasswordController::class, 'checkLogin']);
        Route::post('/reset-password/update', [ResetPasswordController::class, 'updatePassword']);
        
        Route::group(['middleware' => ['auth:sanctum']], function(){
           
            Route::get('/demand/export', [DemandController::class, 'export']);
            Route::resource('demand', DemandController::class)
            ->parameters(['demand' => 'demand']);
    
    
            Route::get('/system/export', [SystemController::class, 'export']);
            Route::resource('system', SystemController::class)
            ->parameters(['system' => 'system']);
    
    
            Route::get('/request/export', [RequestController::class, 'export']);
            Route::resource('request', RequestController::class)
            ->parameters(['request' => 'request']);
            
    
            Route::get('/prioritie/export', [PriorityController::class, 'export']);
            Route::resource('prioritie', PriorityController::class)
            ->parameters(['prioritie' => 'priority']);
    
    
            Route::get('/department/export', [DepartmentController::class, 'export']);
            Route::resource('department', DepartmentController::class)
            ->parameters(['department' => 'department']);
        });

        Route::get('valid', [AuthController::class, 'getValidToken']);
    });

    /*
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    */