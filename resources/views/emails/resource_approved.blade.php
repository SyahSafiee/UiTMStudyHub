<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resource Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px;">
        <h2 style="color: #012E6F;">Congratulations, {{ $resource->user->name }}! 🎉</h2>
        
        <p>Your resource upload has been reviewed and <strong>APPROVED</strong> by the admin.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0;"><strong>Title:</strong> {{ $resource->title }}</p>
            <p style="margin: 0;"><strong>Course Code:</strong> {{ $resource->course_code }}</p>
        </div>

        <p>It is now live in the Library for other students to view and download.</p>
        
        <p style="margin-top: 30px;">
            <a href="{{ route('resources.view', $resource->resources_id) }}"
               style="background-color: #753895; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                View Resource
            </a>
        </p>
        
        <hr style="margin-top: 40px; border: 0; border-top: 1px solid #eee;">
        <p style="font-size: 12px; color: #999;">UiTM StudyHub Notification System</p>
    </div>
</body>
</html>
