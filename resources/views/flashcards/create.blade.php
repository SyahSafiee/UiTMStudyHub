@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto" x-data="flashcardForm()">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-uitm-blue">Create Flashcard Deck</h2>
            <p class="text-gray-500">Create a study deck and add your questions.</p>
        </div>
        
        {{-- Submit Button --}}
        <button type="submit" form="deckForm" class="bg-uitm-violet text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-purple-200 hover:-translate-y-1 transition-all flex items-center gap-2">
            <span>Save Deck</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>

    <form id="deckForm" action="{{ route('flashcards.store') }}" method="POST">
        @csrf

        {{-- Section 1: Deck Info --}}
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
            <h3 class="font-bold text-gray-800 mb-6 text-lg">Deck Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="deck_name" class="block text-sm font-bold text-gray-700 mb-2">Deck Name</label>
                    <input id="deck_name" name="deck_name" required placeholder="e.g. Chapter 4: Database Design"
                        class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet focus:border-uitm-violet transition">
                </div>
                <div>
                    <label for="subject_code" class="block text-sm font-bold text-gray-700 mb-2">Subject Code</label>
                    <input id="subject_code" type="text" name="subject_code" required placeholder="e.g. ICT500"
                        class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet focus:border-uitm-violet transition">
                </div>
            </div>
        </div>

        {{-- Section 2: Cards List (Dynamic) --}}
        <div class="space-y-6">
            {{-- Loop Card Inputs --}}
            <template x-for="(card, index) in cards" :key="index">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative group hover:border-uitm-blue transition-colors">
                    
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-blue-50 text-uitm-blue text-xs font-bold px-3 py-1 rounded-full">
                            Card #<span x-text="index + 1"></span>
                        </span>
                        
                        {{-- Delete Button (Show only if more than 1 card) --}}
                        <button type="button" @click="removeCard(index)" x-show="cards.length > 1"
                            class="text-gray-300 hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Front Input --}}
                        <div>
                            <label for="front" class="block text-xs font-bold text-gray-400 mb-2 uppercase">Front (Question)</label>
                            <textarea id="front" :name="`cards[${index}][front]`" required rows="2" placeholder="Enter question..."
                                class="w-full bg-gray-50 border-transparent rounded-xl p-4 focus:bg-white focus:ring-uitm-violet focus:border-uitm-violet transition resize-none"></textarea>
                        </div>
                        
                        {{-- Back Input --}}
                        <div>
                            <label for="back" class="block text-xs font-bold text-gray-400 mb-2 uppercase">Back (Answer)</label>
                            <textarea id="back" :name="`cards[${index}][back]`" required rows="2" placeholder="Enter answer..."
                                class="w-full bg-gray-50 border-transparent rounded-xl p-4 focus:bg-white focus:ring-uitm-violet focus:border-uitm-violet transition resize-none"></textarea>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Add New Card Button --}}
        <div class="mt-8 text-center">
            <button type="button" @click="addCard()"
                class="bg-white border-2 border-dashed border-gray-300 text-gray-500 px-8 py-4 rounded-2xl font-bold hover:border-uitm-violet hover:text-uitm-violet transition-all w-full flex justify-center items-center gap-2 group">
                <div class="bg-gray-100 group-hover:bg-purple-100 rounded-full p-1 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                Add Another Card
            </button>
        </div>

    </form>
</div>

{{-- Alpine JS Logic --}}
<script>
    function flashcardForm() {
        return {
            cards: [
                { front: '', back: '' } // Start with 1 empty card
            ],
            addCard() {
                this.cards.push({ front: '', back: '' });
            },
            removeCard(index) {
                this.cards.splice(index, 1);
            }
        }
    }
</script>
@endsection
