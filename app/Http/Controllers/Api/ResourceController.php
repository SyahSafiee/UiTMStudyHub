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
        // Fetches ONLY the files belonging to the logged-in student
        $resources = auth()->user()->resources()->latest()->get();
        return view('resources.my-uploads', compact('resources'));
    }

    public function destroy(Resource $resource)
    {
        // Security check: Only allow the owner to delete their own file
        if ($resource->user_id !== auth()->id()) {
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
            'resource_file' => 'required|file|mimes:pdf,docx|max:10240', // 10MB limit
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
}
