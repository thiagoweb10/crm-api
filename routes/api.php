<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\DemandController;
use App\Http\Controllers\API\v1\SystemController;
use App\Http\Controllers\API\v1\RequestController;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;
use App\Http\Controllers\API\v1\PriorityController;
use App\Http\Controllers\crm\DepartamentController;
use App\Http\Controllers\API\v1\DemandReportController;
use App\Http\Controllers\API\v1\DemandStatusController;

    Route::prefix('v1')->group(function(){

        Route::post('login', [AuthController::class, 'login']);

        Route::resource('demand', DemandController::class)
        ->parameters(['demand' => 'demand']);

        Route::resource('export', DemandReportController::class)
        ->parameters(['export' => 'export']);

        Route::middleware([ProtectedRouteAuth::class])->group(function(){
            Route::post('me', [AuthController::class, 'me']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('departament', [DepartamentController::class, 'index']);
            
            //Route::get('demand', [DemandController::class, 'index']);
            //Route::post('demand', [DemandController::class, 'store']);
            
            Route::get('request', [RequestController::class, 'index']);
            Route::get('status', [DemandStatusController::class, 'index']);
            Route::get('user-profile', [UserController::class, 'getUserProfile']);

            Route::resource('priority', PriorityController::class)
            ->parameters(['priority' => 'priority'])
            ->except('show');

            Route::resource('system', SystemController::class)
            ->parameters(['system' => 'system'])
            ->except('show');
        });

        Route::get('valid', [AuthController::class, 'getValidToken']);
    });

    /*
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    */