@extends('layouts.app')

@section('content')
<div class="flex justify-between items-end mb-10">
    <div>
        <h2 class="text-3xl font-extrabold text-uitm-blue">Resource Library</h2>
        <p class="text-gray-500 font-medium">Find notes and materials for your faculty</p>
    </div>
    <button class="bg-uitm-violet text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-purple-200 hover:-translate-y-1 transition-all">
        + Upload New
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($resources as $res)
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-4">
                <span class="bg-blue-50 text-uitm-blue text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                    {{ $res->course_code }}
                </span>
                <span class="text-gray-400 text-xs font-bold uppercase">
                    {{ $res->file_type ?? 'PDF' }}
                </span>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-uitm-violet transition-colors">
                {{ $res->title }}
            </h3>
            <p class="text-gray-500 text-sm mb-6">{{ $res->faculty }}</p>
            
            <div class="flex items-center justify-between mt-auto">
                <div class="flex items-center gap-1">
                    <span class="text-uitm-gold text-sm">★★★★★</span>
                    <span class="text-xs font-bold text-gray-400">{{ $res->rating ?? '5.0' }}</span>
                </div>
                
                <a href="{{ Storage::url($res->file_path) }}" target="_blank" class="bg-uitm-blue text-white px-4 py-2 rounded-lg text-xs font-bold">
                    Download
                </a>
            </div>
            
            <p class="text-[10px] text-gray-400 mt-4">Uploaded by: {{ $res->user->name }}</p>
        </div>
    @empty
        <div class="col-span-3 py-20 text-center">
            <p class="text-gray-400 italic">No resources available yet. Be the first to upload!</p>
        </div>
    @endforelse
</div>
@endsection