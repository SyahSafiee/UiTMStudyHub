<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UiTM StudyHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#003366]">UiTM <span class="text-[#FFCC00]">StudyHub</span></h1>
            <p class="text-gray-500 mt-2">Please login to your account</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-[#003366] text-white font-bold py-2 rounded-lg hover:bg-blue-900 transition duration-200">
                Log In
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Register here</a>
        </div>
    </div>

</body>
</html>
