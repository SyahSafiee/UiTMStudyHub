<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Upload Resource</title>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Academic Resource</h2>
        
        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" class="w-full mt-1 p-2 border rounded-md" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Faculty</label>
                        <input type="text" name="faculty" placeholder="e.g. FSKM" class="w-full mt-1 p-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course Code</label>
                        <input type="text" name="course_code" placeholder="e.g. ITT626" class="w-full mt-1 p-2 border rounded-md" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Select File (PDF/DOCX)</label>
                    <input type="file" name="resource_file" class="w-full mt-1" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                    Upload to Repository
                </button>
                <a href="{{ route('resources.index') }}" class="block text-center text-gray-400 text-sm">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>