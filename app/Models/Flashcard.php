<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flashcard extends Model
{
    protected $primaryKey = 'card_id';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'front_text',
        'back_text',
        'deck_id',
    ];
    
    // ------------------------------------
    // ELOQUENT RELATIONSHIPS
    // ------------------------------------

    /**
     * Get the deck this flashcard belongs to.
     * A Flashcard belongs to one FlashcardDeck.
     */
    public function deck(): BelongsTo
    {
        // Links the FK 'deck_id' in this table to the PK 'deck_id' in the flashcard_decks table
        return $this->belongsTo(FlashcardDeck::class, 'deck_id', 'deck_id');
    }
}
