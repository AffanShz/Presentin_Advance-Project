<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Presentin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Presentin</h2>
            <p class="text-gray-500 mt-2 text-sm">Masuk ke dashboard manajemen presentasi</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6" role="alert">
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6" role="alert">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <form action="/login-action" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" 
                       placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm" 
                       placeholder="••••••••">
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</body>
</html>
