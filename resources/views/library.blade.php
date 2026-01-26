@extends('layouts.app')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h2 class="text-3xl font-extrabold text-uitm-blue">Resource Library</h2>
        <p class="text-gray-500 font-medium">Explore and share academic resources.</p>
    </div>
    
    {{-- Button Upload New (Same as My Uploads) --}}
    <a href="{{ route('resources.create') }}" class="bg-uitm-violet text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-purple-200 hover:-translate-y-1 transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
        Upload New
    </a>
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
            
            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                <div class="flex items-center gap-1">
                    <span class="text-uitm-gold text-sm">★★★★★</span>
                    <span class="text-xs font-bold text-gray-400">{{ $res->rating ?? '5.0' }}</span>
                </div>
                
                <div class="flex gap-2">
                    {{-- Button VIEW (Mata) --}}
                    {{-- target="_blank" supaya buka tab baru --}}
                    <a href="{{ route('resources.view', $res->resources_id) }}" target="_blank"
                       class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition"
                       title="View File">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </a>

                    {{-- Button DOWNLOAD (Arrow) --}}
                    <a href="{{ route('resources.download', $res->resources_id) }}"
                       class="bg-uitm-blue text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-900 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4-4m4 4v12"></path></svg>
                        Download
                    </a>
                </div>
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
