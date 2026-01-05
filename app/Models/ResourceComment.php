<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceComment extends Model
{
    protected $primaryKey = 'comment_id';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'comment_text',
        'resource_id',
        'user_id',
    ];
    
    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the resource this comment belongs to.
     * A ResourceComment belongs to one Resource.
     */
    public function resource(): BelongsTo
    {
        // Links the FK 'resource_id' in this table to the PK 'resources_id' in the resources table
        return $this->belongsTo(Resource::class, 'resource_id', 'resources_id');
    }

    /**
     * Get the user who submitted the comment.
     * A ResourceComment belongs to one User.
     */
    public function user(): BelongsTo
    {
        // Links the FK 'user_id' in this table to the PK 'user_id' in the users table
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
