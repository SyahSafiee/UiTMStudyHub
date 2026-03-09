<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>UiTM StudyHub - Resources</title>
</head>
<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-blue-900">UiTM StudyHub</h1>
            <a href="{{ route('resources.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Upload New Resource</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($resources as $resource)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <span class="text-xs font-bold text-blue-500 uppercase">{{ $resource->course_code }}</span>
                    <h3 class="text-xl font-semibold mt-2">{{ $resource->title }}</h3>
                    <p class="text-gray-500 text-sm italic">Faculty of {{ $resource->faculty }}</p>
                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <span class="text-xs text-gray-400">By {{ $resource->user->name ?? 'User' }}</span>
                        
                        <div class="flex items-center gap-3">
                            {{-- Updated Download Button with Icon --}}
                            <a href="{{ asset('storage/' . $resource->file_url) }}"
                            download="{{ $resource->title }}"
                            class="flex items-center gap-2 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition-colors duration-200 group"
                            title="Download Resource">
                            
                                {{-- Tray Download Icon --}}
                                <svg class="w-5 h-5 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                
                                <span class="text-sm font-bold">Download</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500 italic">No resources available. Be the first to upload!</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
