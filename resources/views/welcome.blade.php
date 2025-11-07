@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-purple-900 text-white">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500 rounded-full opacity-20 animate-float"></div>
    <div class="absolute top-40 right-20 w-16 h-16 bg-purple-500 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-indigo-500 rounded-full opacity-20 animate-float" style="animation-delay: 4s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-slide-up">
                <h1 class="text-5xl lg:text-7xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                        RoomReserve
                    </span>
                    <br>
                    <span class="text-white">Pro</span>
                </h1>
                <p class="text-xl lg:text-2xl text-blue-100 mb-8 leading-relaxed">
                    Experience the future of meeting room booking with our intelligent reservation system. 
                    <span class="text-purple-300 font-semibold">Smart, Fast, Beautiful.</span>
                </p>
                
                @guest
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="group bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="glass text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            Sign In
                        </a>
                        <a href="{{ route('admin') }}" class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Admin Panel
                        </a>
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                            Go to Dashboard
                        </a>
                        <a href="{{ route('bookings.create') }}" class="glass text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            Book a Room
                        </a>
                    </div>
                @endguest
            </div>
            
            <div class="animate-scale-in hidden lg:block">
                <div class="relative">
                    <div class="w-96 h-96 bg-gradient-to-br from-blue-500 to-purple-600 rounded-3xl shadow-2xl transform rotate-6 animate-float"></div>
                    <div class="absolute inset-0 w-96 h-96 glass rounded-3xl flex items-center justify-center transform -rotate-6">
                        <svg class="w-48 h-48 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Why Choose 
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">RoomReserve Pro?</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Experience the next generation of meeting room management with cutting-edge features designed for modern workplaces.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group glass rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">Lightning Fast Booking</h3>
                <p class="text-gray-600 leading-relaxed">
                    Book meeting rooms in seconds with our intuitive interface. One-click booking, instant confirmations, and smart time slot suggestions.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="group glass rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors duration-300">Real-Time Intelligence</h3>
                <p class="text-gray-600 leading-relaxed">
                    Live availability tracking with AI-powered conflict detection. Never worry about double bookings or scheduling conflicts again.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="group glass rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-purple-600 transition-colors duration-300">Advanced Analytics</h3>
                <p class="text-gray-600 leading-relaxed">
                    Comprehensive admin dashboard with usage analytics, booking trends, and detailed reports for optimized space management.
                </p>
            </div>
        </div>
    </div>
</div>

    @php
        $rooms = App\Models\Room::active()->limit(3)->get();
    @endphp

<!-- Rooms Showcase -->
@if($rooms->count() > 0)
<div class="py-24 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Premium 
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Meeting Spaces</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our collection of modern, fully-equipped meeting rooms designed for productivity and collaboration.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($rooms as $room)
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden animate-slide-up">
                <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">{{ $room->name }}</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit($room->description, 100) }}</p>
                    
                    <div class="flex items-center mb-4">
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="font-medium">{{ $room->capacity }} people</span>
                        </div>
                    </div>
                    
                    @if($room->amenities && count($room->amenities) > 0)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach(array_slice($room->amenities, 0, 3) as $amenity)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full font-medium">
                                    {{ str_replace('_', ' ', ucfirst($amenity)) }}
                                </span>
                            @endforeach
                            @if(count($room->amenities) > 3)
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full font-medium">
                                    +{{ count($room->amenities) - 3 }} more
                                </span>
                            @endif
                        </div>
                    @endif
                    
                    <div class="flex gap-3">
                        @auth
                            <a href="{{ route('rooms.show', $room) }}" class="flex-1 px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 text-center font-medium">
                                View Details
                            </a>
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 text-center font-medium transform hover:scale-105">
                                Book Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 text-center font-medium transform hover:scale-105">
                                Login to Book
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @auth
        <div class="text-center">
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                View All Rooms
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
        @endauth
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="relative py-24 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 text-white overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500 rounded-full opacity-10 animate-float"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500 rounded-full opacity-10 animate-float" style="animation-delay: 3s;"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-fade-in">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                Ready to Transform Your 
                <span class="bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent">Workspace?</span>
            </h2>
            <p class="text-xl text-blue-100 mb-12 max-w-2xl mx-auto leading-relaxed">
                Join thousands of companies using RoomReserve Pro for seamless meeting room management.
            </p>
            
            @guest
                <div class="flex flex-col sm:flex-row gap-6 justify-center mb-12">
                    <a href="{{ route('register') }}" class="group bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Free Account
                    </a>
                    <a href="{{ route('admin') }}" class="glass text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Admin Demo
                    </a>
                </div>
                
                <div class="glass rounded-2xl p-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-6 text-yellow-300">🚀 Demo Credentials</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-yellow-300 mb-2">Admin Access</h4>
                            <p class="text-blue-100 text-sm mb-1">📧 admin@example.com</p>
                            <p class="text-blue-100 text-sm">🔑 password</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-green-500 to-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-green-300 mb-2">User Access</h4>
                            <p class="text-blue-100 text-sm mb-1">📧 test@example.com</p>
                            <p class="text-blue-100 text-sm">🔑 password</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center">
                        Go to Dashboard
                    </a>
                    <a href="{{ route('bookings.create') }}" class="glass text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                        Book a Room Now
                    </a>
                </div>
                <p class="text-xl text-purple-200 mt-8">Welcome back, <span class="font-bold text-yellow-300">{{ auth()->user()->name }}</span>! 👋</p>
            @endguest
        </div>
    </div>
</div>
@endsection