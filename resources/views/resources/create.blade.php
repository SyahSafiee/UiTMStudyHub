@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-uitm-blue">Upload New Resource</h2>
        <p class="text-gray-500 font-medium">Share your knowledge with other students.</p>
    </div>

    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                
                {{-- Title Input --}}
                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Resource Title</label>
                    <input id="title" type="text"
                           name="title"
                           required
                           class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet focus:border-uitm-violet transition"
                           placeholder="e.g. Chapter 1: Introduction to Java">
                </div>

                {{-- Course Code & Faculty --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="faculty" class="block text-sm font-bold text-gray-700 mb-2">Faculty</label>
                        <input id="faculty" type="text"
                               name="faculty"
                               required
                               class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet focus:border-uitm-violet transition"
                               placeholder="e.g. FSKM">
                    </div>
                    <div>
                        <label for="course_code" class="block text-sm font-bold text-gray-700 mb-2">Course Code</label>
                        <input id="course_code" type="text"
                               name="course_code"
                               required
                               class="w-full border-gray-200 rounded-xl p-4 focus:ring-uitm-violet focus:border-uitm-violet transition"
                               placeholder="e.g. CSC404">
                    </div>
                </div>

                {{-- Upload Area (Cantik punya design) --}}
                <div>
                    <label for="resource_file" class="block text-sm font-bold text-gray-700 mb-2">Resource File</label>
                    
                    <div class="relative w-full h-48 bg-blue-50 border-2 border-dashed border-uitm-blue rounded-3xl flex flex-col items-center justify-center hover:bg-blue-100 transition-colors cursor-pointer group">
                        
                        {{-- Icon --}}
                        <div class="bg-white p-4 rounded-full shadow-sm mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-uitm-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>

                        <span class="text-uitm-blue font-bold">Click to Upload File</span>
                        <span class="text-gray-400 text-xs mt-1">PDF, DOCX, PPT, PPTX (Max 10MB)</span>

                        {{-- [PENTING] Input File dengan attribute 'accept' --}}
                        <input type="file"
                               name="resource_file"
                               required
                               accept=".pdf,.doc,.docx,.ppt,.pptx"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-uitm-violet text-white py-4 rounded-xl font-bold hover:bg-purple-800 transition shadow-lg shadow-purple-200">
                        Upload to Repository
                    </button>
                    <a href="{{ route('resources.index') }}" class="px-8 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
