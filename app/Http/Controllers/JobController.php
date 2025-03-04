<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JobController extends Controller
{
    /**
     * Get list of all jobs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $jobs = Job::getAllJobs();
        return response()->json($jobs);
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
        $job = Job::getJobById($id);

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