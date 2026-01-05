<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    protected $primaryKey = 'resources_id';

    /**
     * The attributes that are mass assignable.
     * These fields can be safely updated via a Controller.
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
     * A Resource belongs to one User.
     */
    public function user(): BelongsTo
    {
        // Links the FK 'user_id' in the resources table to the PK 'user_id' in the users table
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the ratings for the resource.
     * A Resource can have many Ratings.
     */
    public function ratings(): HasMany
    {
        // Links the FK 'resource_id' in resource_ratings to the PK 'resources_id' in this table
        return $this->hasMany(ResourceRating::class, 'resource_id', 'resources_id');
    }

    /**
     * Get the comments for the resource.
     * A Resource can have many Comments.
     */
    public function comments(): HasMany
    {
        // Links the FK 'resource_id' in resource_comments to the PK 'resources_id' in this table
        return $this->hasMany(ResourceComment::class, 'resource_id', 'resources_id');
    }
}
