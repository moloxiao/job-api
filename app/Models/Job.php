<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all available jobs
     * 
     * @return array
     */
    public static function getAllJobs()
    {
        // In a real application, this would fetch from database
        // This is a placeholder implementation
        return [
            ['id' => 1, 'name' => 'Job 1'],
            ['id' => 2, 'name' => 'Job 2'],
        ];
    }

    /**
     * Get job by ID
     * 
     * @param int $id
     * @return array|null
     */
    public static function getJobById($id)
    {
        // In a real application, this would fetch from database
        // This is a placeholder implementation
        $jobs = [
            1 => ['id' => 1, 'name' => 'Job 1'],
            2 => ['id' => 2, 'name' => 'Job 2'],
        ];

        return array_key_exists($id, $jobs) ? $jobs[$id] : null;
    }
}