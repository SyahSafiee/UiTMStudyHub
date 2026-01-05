<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'faculty',
        'course_code',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the resources uploaded by the user.
     * @return HasMany
     */
    public function resources(): HasMany
    {
        // One user has many resources
        // Custom keys: 'user_id' is the FK in the resources table, 'user_id' is the PK in the users table
        return $this->hasMany(Resource::class, 'user_id', 'user_id');
    }

    /**
     * Get the flashcard decks created by the user.
     * @return HasMany
     */
    public function flashcardDecks(): HasMany
    {
        // One user has many flashcard decks
        return $this->hasMany(FlashcardDeck::class, 'user_id', 'user_id');
    }

    /**
     * Get the ratings given by the user.
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        // One user can submit many ratings
        return $this->hasMany(ResourceRating::class, 'user_id', 'user_id');
    }
    
    /**
     * Get the comments posted by the user.
     * @return HasMany
     */
    public function comments(): HasMany
    {
        // One user can submit many comments
        return $this->hasMany(ResourceComment::class, 'user_id', 'user_id');
    }
}
