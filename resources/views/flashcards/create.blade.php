@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-uitm-blue mb-8">Create New Deck</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Front (Question)</label>
                    <textarea class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet" rows="3" placeholder="Enter your question..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Back (Answer)</label>
                    <textarea class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet" rows="3" placeholder="Enter the answer..."></textarea>
                </div>
                <button class="w-full bg-uitm-violet text-white py-4 rounded-xl font-bold">Add to Deck</button>
            </div>
        </div>

        <div x-data="{ flipped: false }" class="perspective-1000">
            <p class="text-center text-sm font-bold text-gray-400 mb-4">Click card to preview flip</p>
            <div @click="flipped = !flipped" 
                 :class="flipped ? '[transform:rotateY(180deg)]' : ''"
                 class="relative w-full h-64 transition-all duration-500 preserve-3d cursor-pointer">
                
                <div class="absolute inset-0 bg-uitm-blue text-white rounded-3xl flex items-center justify-center p-8 backface-hidden">
                    <span class="text-xl font-bold text-center">Your Question Will Appear Here</span>
                </div>

                <div class="absolute inset-0 bg-uitm-gold text-uitm-blue rounded-3xl flex items-center justify-center p-8 [transform:rotateY(180deg)] backface-hidden">
                    <span class="text-xl font-bold text-center">Your Answer Will Appear Here</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection