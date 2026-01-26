@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-uitm-blue">Flashcard Decks</h2>
            <p class="text-gray-500 font-medium">Review and study decks.</p>
        </div>
        
        <a href="{{ route('flashcards.create') }}" class="bg-uitm-violet text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-purple-200 hover:-translate-y-1 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create New Deck
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($decks as $deck)
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all group relative overflow-hidden">
                {{-- Decorative Background Circle --}}
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full group-hover:bg-purple-100 transition-colors"></div>

                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-blue-50 text-uitm-blue text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                            {{ $deck->subject_code }}
                        </span>
                        <span class="text-gray-400 text-xs font-bold">
                            {{ $deck->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-uitm-violet transition-colors">
                        {{ $deck->deck_name }}
                    </h3>

                    {{-- CREATED BY SECTION --}}
                    <p class="text-[11px] text-gray-400 mb-4 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Created by: <span class="font-bold text-gray-600">{{ $deck->user->name ?? 'Unknown' }}</span>
                    </p>
                    
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-6">
                        <svg class="w-4 h-4 text-uitm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>{{ $deck->flashcards_count }} Cards</span>
                    </div>
                    
                    <div class="border-t border-gray-50 pt-4 flex justify-between items-center mt-auto">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Tap to Study</p>
                        
                        <a href="{{ route('flashcards.show', $deck->deck_id) }}" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-uitm-violet group-hover:text-white transition-all z-20 relative">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-20 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">No Decks Yet</h3>
                <p class="text-gray-400 text-sm mb-6">Create your first flashcard deck to start studying.</p>
                <a href="{{ route('flashcards.create') }}" class="text-uitm-violet font-bold hover:underline">Create Now &rarr;</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
