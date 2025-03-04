<?php

namespace App\Http\Controllers;

use App\Models\BuilderJob;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class BuilderJobController extends Controller
{
    /**
     * Get list of all jobs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            Log::info('index coming');
            $jobs = BuilderJob::getAllBuilderJobs();
            return response()->json($jobs);
        } catch (\Exception $e) {
            Log::error('Job list error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get job details by id
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        // Get authenticated user - just for test jwt
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $userName = $user->name;

        // Get job data from model
        $job = BuilderJob::getBuilderJobById($id);

        if ($job) {
            $response = $job;
            $response['userId'] = $userId;
            $response['userName'] = $userName;
            
            return response()->json($response);
        } else {
            return response()->json(['error' => 'Job not found'], 404);
        }
    }
}