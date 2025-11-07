<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - RoomReserve Pro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 min-h-screen flex items-center justify-center">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full opacity-10 animate-float"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-purple-500 rounded-full opacity-10 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-pink-500 rounded-full opacity-10 animate-float" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-indigo-500 rounded-full opacity-10 animate-float" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative max-w-md w-full mx-4">
        <div class="glass rounded-3xl shadow-2xl overflow-hidden animate-scale-in">
            <!-- Header -->
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-8 text-center text-white">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold mb-2">Admin Panel</h2>
                <p class="text-yellow-100">RoomReserve Pro Management</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Alerts -->
                @if(session('info'))
                    <div class="mb-6 glass rounded-lg p-4 border-l-4 border-blue-500 animate-slide-up">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-blue-800 font-medium">{{ session('info') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 glass rounded-lg p-4 border-l-4 border-red-500 animate-slide-up">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-red-800">
                                @foreach($errors->all() as $error)
                                    <p class="font-medium">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="redirect_to" value="admin">

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('email') border-red-500 @enderror" 
                               placeholder="Enter admin email" required autofocus>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Password
                        </label>
                        <input type="password" id="password" name="password" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('password') border-red-500 @enderror" 
                               placeholder="Enter password" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Access Admin Panel
                    </button>
                </form>

                <!-- Demo Credentials -->
                <div class="mt-8 glass rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        🚀 Demo Credentials
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Admin Account 1:</h4>
                            <p class="text-sm text-gray-600 mb-1">📧 admin@example.com</p>
                            <p class="text-sm text-gray-600">🔑 password</p>
                        </div>
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Admin Account 2:</h4>
                            <p class="text-sm text-gray-600 mb-1">📧 admin@roomreserve.com</p>
                            <p class="text-sm text-gray-600">🔑 password</p>
                        </div>
                    </div>
                </div>

                <!-- Back to Homepage -->
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>