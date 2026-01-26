@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-uitm-blue">Admin Dashboard</h2>
    <p class="text-gray-500">Overview of platform activity and pending approvals.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm font-bold rounded shadow-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Users</p>
        <p class="text-3xl font-black text-uitm-blue mt-2">{{ $stats['total_users'] ?? '0' }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pending Files</p>
        <p class="text-3xl font-black text-orange-500 mt-2">{{ $stats['pending'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Approved</p>
        <p class="text-3xl font-black text-green-500 mt-2">{{ $stats['approved'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Files</p>
        <p class="text-3xl font-black text-gray-800 mt-2">{{ $stats['total_files'] }}</p>
    </div>
</div>

{{-- Pending Table --}}
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Pending Resource Approvals</h3>
        <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
            {{ $pendingResources->count() }} Waiting
        </span>
    </div>
    
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold">
            <tr>
                <th class="px-6 py-4">Resource Title</th>
                <th class="px-6 py-4">Uploader</th>
                <th class="px-6 py-4 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pendingResources as $res)
                <tr>
                    {{-- Column 1: Title & Course Code --}}
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-700">{{ $res->title }}</div>
                        <div class="text-[10px] text-gray-400 uppercase">{{ $res->course_code }}</div>
                    </td>

                    {{-- Column 2: Uploader --}}
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div>{{ $res->user->name ?? 'Unknown' }}</div>
                        <div class="text-xs text-gray-400">{{ $res->user->email ?? '' }}</div>
                    </td>

                    {{-- Column 3: Actions (View, Approve, Reject) --}}
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            
                            {{-- View Button --}}
                            <a href="{{ route('resources.view', $res->resources_id) }}" target="_blank"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1"
                               title="Preview File">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View
                            </a>

                            {{-- Approve Form --}}
                            <form action="{{ route('admin.resources.status', $res->resources_id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Approve
                                </button>
                            </form>

                            {{-- Reject Form --}}
                            <form action="{{ route('admin.resources.status', $res->resources_id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Reject
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-20 text-center text-gray-400 italic">
                        No pending resources to review. Good job!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
