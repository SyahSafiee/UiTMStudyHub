@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-uitm-blue">Admin Dashboard</h2>
    <p class="text-gray-500">Overview of platform activity and pending approvals.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Users</p>
        <p class="text-3xl font-black text-uitm-blue mt-2">1,284</p>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pending Files</p>
        <p class="text-3xl font-black text-orange-500 mt-2">12</p>
    </div>
    </div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
        <h3 class="font-bold text-gray-800">Pending Resource Approvals</h3>
    </div>
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold">
            <tr>
                <th class="px-6 py-4">Resource Title</th>
                <th class="px-6 py-4">Uploader</th>
                <th class="px-6 py-4">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <tr>
                <td class="px-6 py-4 font-semibold text-gray-700">Calculus II Study Guide</td>
                <td class="px-6 py-4 text-sm text-gray-500">ali@student.uitm.edu.my</td>
                <td class="px-6 py-4 flex gap-2">
                    <button class="bg-green-500 text-white px-4 py-1.5 rounded-lg text-xs font-bold">Approve</button>
                    <button class="bg-red-500 text-white px-4 py-1.5 rounded-lg text-xs font-bold">Reject</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection