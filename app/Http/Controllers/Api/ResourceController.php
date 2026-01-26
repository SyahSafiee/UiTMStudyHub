<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resource::where('status', 'approved');

        // IF the user searched for something, filter the results
        if ($request->has('search')) {
            $query->where('course_code', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title', 'LIKE', '%' . $request->search . '%');
        }

        $resources = $query->with('user')->get();
        
        return view('library', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Display the authenticated user's uploaded resources.
     */
    public function myUploads()
    {
        /** @var \App\Models\User $user */ // <--- This line tells the IDE exactly what $user is
        $user = Auth::user();

        if (!$user) {
        return redirect()->route('login');
        }

        // Now 'resources()' will NOT be undefined because we added it to User.php
        $resources = $user->resources()->latest()->get();
    
        return view('resources.my-uploads', compact('resources'));
    }

    public function destroy(Resource $resource)
    {
        // Use Auth::id() instead of auth()->id() to keep the IDE happy
    if ($resource->user_id !== Auth::id()) {
        abort(403);
    }

    $resource->delete();
    return back()->with('success', 'Resource deleted successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'faculty' => 'required|string',
            'course_code' => 'required|string',
            'resource_file' => 'required|file|mimes:pdf,docx,ppt,pptx|max:10240', // 10MB limit
        ]);

        if ($request->hasFile('resource_file')) {
            $file = $request->file('resource_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/resources', $fileName, 'public');

            Resource::create([
                'title' => $request->title,
                'description' => $request->description,
                'faculty' => $request->faculty,
                'course_code' => $request->course_code,
                'file_url' => $filePath,
                'user_id' => Auth::id() ?? 1, // Fallback to ID 1 if not logged in for demo
                'status' => 'pending', // Needs admin approval
            ]);

            return redirect()->route('resources.index')->with('success', 'Resource uploaded! Waiting for admin approval.');
        }

        return back()->with('error', 'File upload failed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Force download the resource file.
     */
    public function download($id)
    {
        $resource = Resource::findOrFail($id);
        
        // Pastikan file wujud dalam storage public
        if (!Storage::disk('public')->exists($resource->file_url)) {
            return back()->with('error', 'File not found on server.');
        }

        // Paksa browser download file tu
        // Argument ke-2 tu untuk set nama file yang cantik bila user download
        $extension = pathinfo($resource->file_url, PATHINFO_EXTENSION);
        $fileName = $resource->title . '.' . $extension;
        return response()->download(storage_path('app/public/' . $resource->file_url), $fileName);
    }

    /**
     * View the resource file in browser (Stream).
     */
    public function view($id)
    {
        $resource = Resource::findOrFail($id);

        if (!Storage::disk('public')->exists($resource->file_url)) {
            return back()->with('error', 'File not found on server.');
        }

        // Return file sebagai response supaya browser boleh render (PDF/Image)
        return response()->file(storage_path('app/public/' . $resource->file_url));
    }
}
