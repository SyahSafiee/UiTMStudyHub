@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto" x-data="studySession({{ $deck->flashcards->toJson() }})">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <a href="{{ route('flashcards.index') }}" class="text-gray-400 hover:text-uitm-blue text-sm font-bold flex items-center gap-1 mb-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Library
            </a>
            <h2 class="text-3xl font-extrabold text-uitm-blue">{{ $deck->deck_name }}</h2>
            <p class="text-gray-500 text-sm font-medium">{{ $deck->subject_code }} • <span x-text="cards.length"></span> Cards</p>
        </div>
        
        <div class="text-right">
            <span class="text-4xl font-black text-gray-200" x-text="currentIndex + 1"></span>
            <span class="text-xl font-bold text-gray-300">/ <span x-text="cards.length"></span></span>
        </div>
    </div>

    {{-- FLASHCARD CONTAINER --}}
    <div class="perspective-1000 w-full h-96 cursor-pointer group" @click="flipCard()">
        <div class="relative w-full h-full transition-all duration-500 preserve-3d shadow-xl rounded-3xl"
             :class="flipped ? '[transform:rotateY(180deg)]' : ''">
            
            {{-- FRONT SIDE (Question) --}}
            <div class="absolute inset-0 bg-white border border-gray-100 rounded-3xl p-10 flex flex-col items-center justify-center text-center backface-hidden">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Question</span>
                <p class="text-2xl font-bold text-gray-800" x-text="currentCard.front_text"></p>
                <p class="absolute bottom-6 text-xs text-gray-300 font-bold animate-pulse">Tap to flip</p>
            </div>

            {{-- BACK SIDE (Answer) --}}
            <div class="absolute inset-0 bg-uitm-blue rounded-3xl p-10 flex flex-col items-center justify-center text-center backface-hidden [transform:rotateY(180deg)]">
                <span class="text-xs font-bold text-blue-200 uppercase tracking-widest mb-4">Answer</span>
                <p class="text-2xl font-bold text-white" x-text="currentCard.back_text"></p>
            </div>
            
        </div>
    </div>

    {{-- NAVIGATION CONTROLS --}}
    <div class="flex justify-center items-center gap-6 mt-10">
        {{-- Prev Button --}}
        <button @click="prevCard()" :disabled="currentIndex === 0"
                class="w-14 h-14 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-50 hover:scale-105 transition disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        {{-- Progress Bar --}}
        <div class="w-64 h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-uitm-violet transition-all duration-300" :style="`width: ${((currentIndex + 1) / cards.length) * 100}%`"></div>
        </div>

        {{-- Next Button --}}
        <button @click="nextCard()" :disabled="currentIndex === cards.length - 1"
                class="w-14 h-14 rounded-full bg-uitm-violet shadow-lg shadow-purple-200 flex items-center justify-center text-white hover:bg-purple-800 hover:scale-105 transition disabled:opacity-50 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</div>

<script>
    function studySession(cardsData) {
        return {
            cards: cardsData,
            currentIndex: 0,
            flipped: false,
            
            get currentCard() {
                return this.cards[this.currentIndex];
            },

            flipCard() {
                this.flipped = !this.flipped;
            },

            nextCard() {
                if (this.currentIndex < this.cards.length - 1) {
                    this.flipped = false; // Reset flip bila tukar kad
                    setTimeout(() => {
                        this.currentIndex++;
                    }, 200); // Tunggu kejap bagi animation flip balik smooth
                }
            },

            prevCard() {
                if (this.currentIndex > 0) {
                    this.flipped = false;
                    setTimeout(() => {
                        this.currentIndex--;
                    }, 200);
                }
            }
        }
    }
</script>
@endsection
