@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-uitm-blue">Account Settings</h2>
        <p class="text-gray-500">Manage security and account preferences.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-bold">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-8">
        
        {{-- CARD 1: CHANGE PASSWORD --}}
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-uitm-blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Change Password</h3>
                    <p class="text-xs text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>

            <form action="{{ route('settings.password.update') }}" method="POST" class="max-w-xl">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                        <input id="current_password" type="password" name="current_password" required
                            class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full border-gray-200 rounded-xl p-3 focus:ring-uitm-violet focus:border-uitm-violet transition">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-black transition text-sm shadow-lg">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- CARD 2: DANGER ZONE (DELETE ACCOUNT) --}}
        <div class="bg-red-50 rounded-3xl p-8 shadow-sm border border-red-100">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-red-700 text-lg">Delete Account</h3>
                    <p class="text-xs text-red-400">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = true" class="bg-red-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-red-700 transition text-sm shadow-lg shadow-red-200">
                    Delete Account
                </button>

                {{-- Modal Confirmation --}}
                <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" style="display: none;">
                    <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl mx-4" @click.away="open = false">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Are you absolutely sure?</h2>
                        <p class="text-gray-500 text-sm mb-6">
                            This action cannot be undone. This will permanently delete your account and remove your data from UiTM StudyHub.
                        </p>

                        <form action="{{ route('settings.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="mb-6">
                                <label for="confirm_password" class="block text-sm font-bold text-gray-700 mb-2">Enter your password to confirm</label>
                                <input id="confirm_password" type="password" name="password" required placeholder="Password"
                                    class="w-full border-gray-200 rounded-xl p-3 focus:ring-red-500 focus:border-red-500">
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" @click="open = false" class="px-4 py-2 text-gray-500 font-bold hover:bg-gray-100 rounded-lg transition">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-lg">
                                    Yes, Delete My Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
