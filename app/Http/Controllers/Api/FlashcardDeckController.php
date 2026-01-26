<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashcardDeck;
use App\Models\Flashcard;
use Illuminate\Support\Facades\Auth;

class FlashcardDeckController extends Controller
{
    /**
     * Display a listing of the resource (Flashcard Library).
     */
    public function index(Request $request)
    {
        // Start query asas
        $query = FlashcardDeck::with('user')
                    ->withCount('flashcards')
                    ->latest();

        // [BARU] Logic Search
        if ($request->has('search')) {
            $keyword = $request->search;
            
            // Cari dalam tajuk deck ATAU subject code
            $query->where(function($q) use ($keyword) {
                $q->where('deck_name', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('subject_code', 'LIKE', '%' . $keyword . '%');
            });
        }

        $decks = $query->get();

        return view('flashcards.index', compact('decks'));
    }

    /**
     * Show the form for creating a new deck.
     */
    public function create()
    {
        return view('flashcards.create');
    }

    /**
     * Store a newly created deck and its cards.
     */
    public function store(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'deck_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50',
            'cards' => 'required|array|min:1', // Mesti ada sekurang-kurangnya 1 kad
            'cards.*.front' => 'required|string', // Check setiap kad mesti ada soalan
            'cards.*.back' => 'required|string',  // Check setiap kad mesti ada jawapan
        ]);

        // 2. Create Deck (Header)
        $deck = FlashcardDeck::create([
            'deck_name' => $request->deck_name,
            'subject_code' => $request->subject_code,
            'user_id' => Auth::id(),
        ]);

        // 3. Create Cards (Items) - Loop array dari form
        foreach ($request->cards as $cardData) {
            Flashcard::create([
                'deck_id' => $deck->deck_id, // Link kan dengan deck baru tadi
                'front_text' => $cardData['front'],
                'back_text' => $cardData['back'],
            ]);
        }

        // 4. Redirect
        return redirect()->route('flashcards.index')->with('success', 'Flashcard Deck created successfully!');
    }

    /**
     * Display the specified deck for studying.
     */
    public function show($id)
    {
        // Tarik deck sekali dengan semua flashcards dia
        $deck = FlashcardDeck::with('flashcards')->findOrFail($id);
        
        return view('flashcards.study', compact('deck'));
    }
}
