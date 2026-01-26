@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-uitm-blue">My Profile</h2>
        <p class="text-gray-500">Manage your account information and preferences.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Card Kiri: Gambar & Info Ringkas --}}
        <div class="md:col-span-1">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 text-center h-full">
                <div class="w-24 h-24 bg-uitm-violet text-white text-3xl font-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-purple-200">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $user->name }}</h3>
                <p class="text-xs font-bold text-uitm-blue bg-blue-50 py-1 px-3 rounded-full inline-block mt-2 uppercase tracking-wider">
                    {{ $user->role }}
                </p>
                
                <div class="mt-8 text-left space-y-3">
                    <div>
                        <span class="block text-[10px] text-gray-400 uppercase font-bold">Joined Date</span>
                        <span class="text-sm font-medium text-gray-600">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] text-gray-400 uppercase font-bold">Email Status</span>
                        @if($user->email_verified_at)
                            <span class="text-xs font-bold text-green-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Verified
                            </span>
                        @else
                            <span class="text-xs font-bold text-red-500">Unverified</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Kanan: Edit Form --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-6 text-xl">Edit Information</h3>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-5">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                            @error('name') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full border-gray-200 rounded-xl p-3 bg-gray-50 text-gray-500 cursor-not-allowed"
                                readonly
                                title="Please contact admin to change email">
                            <p class="text-[10px] text-gray-400 mt-1">*Student Email cannot be changed directly.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- Faculty --}}
                            <div>
                                <label for="faculty" class="block text-sm font-bold text-gray-700 mb-2">Faculty</label>
                                <input id="faculty" type="text" name="faculty" value="{{ old('faculty', $user->faculty) }}" required placeholder="e.g. FSKM"
                                    class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                                @error('faculty') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Course Code --}}
                            <div>
                                <label for="course_code" class="block text-sm font-bold text-gray-700 mb-2">Course Code</label>
                                <input id="course_code" type="text" name="course_code" value="{{ old('course_code', $user->course_code) }}" required placeholder="e.g. CS240"
                                    class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                                @error('course_code') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-uitm-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-900 transition shadow-lg hover:-translate-y-1">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
