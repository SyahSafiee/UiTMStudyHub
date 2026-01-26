@extends('layouts.app')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h2 class="text-3xl font-bold text-uitm-blue">My Uploads</h2>
        <p class="text-gray-500 font-medium">Manage and track your shared study materials</p>
    </div>
    <a href="{{ route('resources.create') }}" class="bg-uitm-violet text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:opacity-90 transition">
        + Upload New
    </a>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold tracking-widest">
            <tr>
                <th class="px-8 py-5">Resource Details</th>
                <th class="px-8 py-5">Date Uploaded</th>
                <th class="px-8 py-5">Status</th>
                <th class="px-8 py-5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($resources as $res)
            <tr class="hover:bg-gray-50/50 transition">
                <td class="px-8 py-5">
                    <div class="font-bold text-gray-800">{{ $res->title }}</div>
                    <div class="text-xs text-uitm-blue font-bold opacity-60">{{ $res->course_code }}</div>
                </td>
                <td class="px-8 py-5 text-sm text-gray-500">
                    {{ $res->created_at->format('d M Y') }}
                </td>
                <td class="px-8 py-5">
                    @if($res->status == 'approved')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Approved</span>
                    @elseif($res->status == 'pending')
                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Pending</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black uppercase">Rejected</span>
                    @endif
                </td>
                <td class="px-8 py-5 text-right">
                    <form action="{{ route('resources.destroy', $res->resources_id) }}" method="POST" onsubmit="return confirm('Delete this resource?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 transition font-bold text-xs">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-8 py-20 text-center">
                    <div class="text-gray-400 italic">You haven't uploaded any resources yet.</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
