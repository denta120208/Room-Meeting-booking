<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RoomReserve Pro') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/heroicons@2.0.16/24/outline/index.css">
    <script src="https://unpkg.com/heroicons@2.0.16/24/outline/index.js"></script>
    
    <!-- Scripts -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
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
    @endif
    
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
        .glass-dark {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Modern Glassmorphism Navigation -->
    <nav class="fixed w-full z-50 top-0 glass-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 text-white hover:text-blue-300 transition-colors duration-200">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">RoomReserve Pro</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Dashboard</a>
                            <a href="{{ route('rooms.index') }}" class="text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Rooms</a>
                            <a href="{{ route('bookings.index') }}" class="text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">My Bookings</a>
                            <a href="{{ route('bookings.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">Book Room</a>
                            @if(auth()->user()->isAdmin())
                                <div class="relative group">
                                    <button class="text-yellow-300 hover:text-yellow-200 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                                        Admin
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg glass opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                        <div class="py-1">
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Dashboard</a>
                                            <a href="{{ route('admin.rooms.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Manage Rooms</a>
                                            <a href="{{ route('admin.bookings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">All Bookings</a>
                                            <a href="{{ route('admin.blocks') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Blocks</a>
                                            <a href="{{ route('admin.statistics') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Statistics</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- User Menu -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @guest
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Login</a>
                            <a href="{{ route('register') }}" class="ml-3 bg-gradient-to-r from-green-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-green-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105">Register</a>
                        @else
                            <div class="relative group">
                                <button class="flex items-center text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold mr-2">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    {{ auth()->user()->name }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg glass opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <div class="py-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-white hover:text-blue-300 p-2" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden glass-dark">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-300 block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="{{ route('rooms.index') }}" class="text-white hover:text-blue-300 block px-3 py-2 rounded-md text-base font-medium">Rooms</a>
                    <a href="{{ route('bookings.index') }}" class="text-white hover:text-blue-300 block px-3 py-2 rounded-md text-base font-medium">My Bookings</a>
                    <a href="{{ route('bookings.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white block px-3 py-2 rounded-md text-base font-medium">Book Room</a>
                    @if(auth()->user()->isAdmin())
                        <div class="border-t border-gray-700 mt-2 pt-2">
                            <div class="text-yellow-300 px-3 py-1 text-sm font-medium">Admin</div>
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-blue-300 block px-6 py-1 text-sm">Dashboard</a>
                            <a href="{{ route('admin.rooms.index') }}" class="text-white hover:text-blue-300 block px-6 py-1 text-sm">Manage Rooms</a>
                            <a href="{{ route('admin.bookings') }}" class="text-white hover:text-blue-300 block px-6 py-1 text-sm">All Bookings</a>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-300 block px-3 py-2 rounded-md text-base font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-500 to-blue-600 text-white block px-3 py-2 rounded-md text-base font-medium">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="mb-6 animate-slide-up">
                    <div class="glass rounded-lg p-4 border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Alerts -->
            @if($errors->any())
                <div class="mb-6 animate-slide-up">
                    <div class="glass rounded-lg p-4 border-l-4 border-red-500">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <div class="text-red-800">
                                    @foreach($errors->all() as $error)
                                        <p class="font-medium">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ml-auto pl-3">
                                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Floating Action Button (Book Room) -->
    @auth
        <div class="fixed bottom-6 right-6 z-40">
            <a href="{{ route('bookings.create') }}" class="group bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full p-4 shadow-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-110 flex items-center">
                <svg class="w-6 h-6 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="ml-2 hidden group-hover:block animate-fade-in">Quick Book</span>
            </a>
        </div>
    @endauth

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[class*="alert"]');
            alerts.forEach(alert => {
                if (alert.parentElement) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Add loading states to buttons
        document.querySelectorAll('button[type="submit"], a[href*="bookings.create"]').forEach(button => {
            button.addEventListener('click', function() {
                if (this.tagName === 'BUTTON' && !this.disabled) {
                    this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Loading...';
                    this.disabled = true;
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>