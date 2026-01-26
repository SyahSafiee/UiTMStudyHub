<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // 1. Validate Input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'faculty' => ['required', 'string', 'max:100'],     // Wajib isi Faculty
            'course_code' => ['required', 'string', 'max:20'],  // Wajib isi Course Code
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->user_id, 'user_id') // Ignore current user's email check
            ],
        ]);

        // 2. Update Data User
        $request->user()->fill($validated);

        // Kalau user tukar email, reset verification (Optional, terpulang nak on ke tak)
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
