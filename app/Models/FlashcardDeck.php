<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FlashcardDeck extends Model
{
    protected $primaryKey = 'deck_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'deck_name',
        'subject_code',
        'user_id',
    ];
    
    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the user who created the deck.
     * A FlashcardDeck belongs to one User.
     */
    public function user(): BelongsTo
    {
        // Links the FK 'user_id' in this table to the PK 'user_id' in the users table
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the individual flashcards belonging to this deck.
     * A FlashcardDeck has many Flashcards.
     */
    public function flashcards(): HasMany
    {
        // Links the FK 'deck_id' in the flashcards table to the PK 'deck_id' in this table
        return $this->hasMany(Flashcard::class, 'deck_id', 'deck_id');
    }
}
