<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    // Ensure this matches your database column exactly (resources_id vs resource_id)
    protected $primaryKey = 'resources_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'file_url',
        'faculty',
        'course_code',
        'status',
        'user_id',
    ];
    
    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the user who uploaded the resource.
     */
    public function user(): BelongsTo
    {
        // Linking user_id (FK) to user_id (PK in users table)
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the ratings for the resource.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(ResourceRating::class, 'resource_id', 'resources_id');
    }

    /**
     * Get the comments for the resource.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ResourceComment::class, 'resource_id', 'resources_id');
    }
}
