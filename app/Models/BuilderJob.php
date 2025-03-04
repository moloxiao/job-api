<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuilderJob extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'builder_jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get all available jobs
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllBuilderJobs()
    {
        return self::all(['id', 'name', 'description']);
    }

    /**
     * Get job by ID
     * 
     * @param int $id
     * @return array|null
     */
    public static function getBuilderJobById($id)
    {
        return self::find($id);
    }
}