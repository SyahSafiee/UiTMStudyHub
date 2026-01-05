<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceRating extends Model
{
    protected $primaryKey = 'rating_id';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'rating_value',
        'resource_id',
        'user_id',
    ];
    
    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the resource that was rated.
     * A ResourceRating belongs to one Resource.
     */
    public function resource(): BelongsTo
    {
        // Links the FK 'resource_id' in this table to the PK 'resources_id' in the resources table
        return $this->belongsTo(Resource::class, 'resource_id', 'resources_id');
    }

    /**
     * Get the user who submitted the rating.
     * A ResourceRating belongs to one User.
     */
    public function user(): BelongsTo
    {
        // Links the FK 'user_id' in this table to the PK 'user_id' in the users table
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
