<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Tymon\JWTAuth\Facades\JWTAuth;


Route::prefix('v1')->group(function () {

    Route::post('/auth/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:api')->group(function () {

        Route::get('/jobs/list', function () {
            $jobs = [
                ['id' => 1, 'name' => 'Job 1'],
                ['id' => 2, 'name' => 'Job 2'],
            ];
            return response()->json($jobs);
        });


        Route::get('/jobs/{id}', function ($id, Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $userId = $user->id;
            $userName = $user->name;
            $jobs = [
                1 => ['id' => 1, 'name' => 'Job 1'],
                2 => ['id' => 2, 'name' => 'Job 2'],
            ];

            if (array_key_exists($id, $jobs)) {
                $response = $jobs[$id];
                $response['userId'] = $userId;
                $response['userName'] = $userName;
                return response()->json($response);
            } else {
                return response()->json(['error' => 'Job not found'], 404);
            }
        });
    });
    
});
