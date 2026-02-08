<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Wajib ada untuk hantar email
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with pending resources.
     */
    public function index()
    {
        // Ambil resource yang status 'pending' bersama info uploader (user)
        $pendingResources = Resource::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Data untuk dashboard cards
        $stats = [
            'pending'     => $pendingResources->count(),
            'approved'    => Resource::where('status', 'approved')->count(),
            'total_files' => Resource::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('pendingResources', 'stats'));
    }

    /**
     * Update the status of a resource (Approve/Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Cari resource. Guna 'with' user supaya kita boleh dapat email dia
        $resource = Resource::with('user')->findOrFail($id);
        
        $resource->update([
            'status' => $request->status
        ]);

        // =========================================================
        // ONE-FILE EMAIL SOLUTION (Direct HTML)
        // =========================================================
        if ($request->status === 'approved' && $resource->user && $resource->user->email) {
            
            $userName = $resource->user->name;
            $userEmail = $resource->user->email;
            $title = $resource->title;

            // 1. Design HTML Email secara terus
            $htmlContent = "
                <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f4f6f9;'>
                    <div style='max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05);'>
                        
                        <h2 style='color: #012E6F; margin-top: 0;'>🎉 Resource Approved!</h2>
                        <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                        
                        <p style='color: #475569;'>Hi <strong>{$userName}</strong>,</p>
                        
                        <p style='color: #475569;'>Good news! Your academic resource has been reviewed and is now live in the library.</p>
                        
                        <div style='background-color: #f8fafc; padding: 15px; border-left: 4px solid #753895; margin: 20px 0;'>
                            <p style='margin: 0; color: #1e293b;'><strong>Title:</strong> {$title}</p>
                            <p style='margin: 5px 0 0 0; color: #16a34a;'><strong>Status:</strong> APPROVED</p>
                        </div>

                        <p style='color: #475569;'>Other students can now benefit from your contribution. Thank you for sharing!</p>
                        
                        <div style='margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px;'>
                            <p style='color: #94a3b8; font-size: 12px;'>
                                Regards,<br>
                                <strong>UiTM StudyHub Admin</strong>
                            </p>
                        </div>
                    </div>
                </div>
            ";

            // 2. Hantar guna Mail::html()
            try {
                Mail::html($htmlContent, function($message) use ($userEmail) {
                    $message->to($userEmail)
                            ->subject('UiTM StudyHub: Your Resource is Approved!');
                });
            } catch (\Exception $e) {
                // PADAM COMMENT DI BAWAH NI UNTUK TENGOK ERROR
                dd($e->getMessage());
            }
        }
        // =========================================================

        $message = $request->status === 'approved'
            ? '✅ Resource approved & notification email sent!'
            : '❌ Resource has been rejected.';

        return back()->with('success', $message);
    }

    /**
     * View the file of a resource (Admin).
     */
    public function viewFile($id)
    {
        // Find the resource using your primary key 'resources_id'
        $resource = Resource::findOrFail($id);
        
        // Get the path from storage (assuming you use the 'public' disk)
        $path = storage_path('app/public/' . $resource->file_url);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        // response()->file() sets the Content-Disposition to 'inline' by default
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
