@extends('layouts.app')

@section('content')
<!-- Admin Header -->
<div class="relative bg-gradient-to-br from-yellow-500 via-orange-500 to-red-500 text-white rounded-3xl mb-8 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="20" cy="20" r="2"/></g></svg>');"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-4 right-8 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float"></div>
    <div class="absolute bottom-4 left-8 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
    
    <div class="relative p-8 lg:p-12">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="flex-1 animate-slide-up">
                <div class="flex items-center mb-4">
                    <div class="w-20 h-20 bg-gradient-to-br from-white to-yellow-100 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            Admin <span class="text-yellow-200">Dashboard</span> 👑
                        </h1>
                        <p class="text-orange-100 text-lg">
                            Welcome back, <span class="font-semibold text-yellow-200">{{ auth()->user()->name }}</span>! Ready to manage your empire?
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        System Administrator
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-green-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <div class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></div>
                        Online
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block animate-scale-in">
                <div class="w-32 h-32 bg-gradient-to-br from-white to-orange-100 rounded-full flex items-center justify-center opacity-30 shadow-2xl">
                    <svg class="w-20 h-20 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
    <!-- Total Rooms -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Rooms</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalRooms }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Rooms -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Active Rooms</p>
                <p class="text-3xl font-bold text-gray-900">{{ $activeRooms }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Bookings -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Bookings</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalBookings }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Today's Bookings -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.3s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Today's Bookings</p>
                <p class="text-3xl font-bold text-gray-900">{{ $todayBookings }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Upcoming Bookings -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.4s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Upcoming</p>
                <p class="text-3xl font-bold text-gray-900">{{ $upcomingBookings }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.5s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Recent Bookings -->
    <div class="glass rounded-2xl p-6 animate-fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                📅 Recent Bookings
            </h3>
            <a href="{{ route('admin.bookings') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                View All →
            </a>
        </div>
        
        @if($recentBookings->count() > 0)
            <div class="space-y-4">
                @foreach($recentBookings as $booking)
                    <div class="flex items-center justify-between p-4 bg-white bg-opacity-50 rounded-xl hover:bg-opacity-80 transition-all duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ substr($booking->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $booking->room->name }}</p>
                                <p class="text-xs text-gray-500">{{ $booking->start_time->format('M j, Y') }}</p>
                            </div>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800'
                                ];
                                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500">No recent bookings</p>
            </div>
        @endif
    </div>

    <!-- Room Statistics -->
    <div class="glass rounded-2xl p-6 animate-fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                📊 Room Statistics
            </h3>
            <a href="{{ route('admin.statistics') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                Details →
            </a>
        </div>
        
        @if($roomStats->count() > 0)
            <div class="space-y-4">
                @foreach($roomStats as $room)
                    <div class="flex items-center justify-between p-4 bg-white bg-opacity-50 rounded-xl hover:bg-opacity-80 transition-all duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-400 to-pink-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $room->name }}</p>
                                <div class="flex space-x-4 text-sm text-gray-600">
                                    <span>📊 {{ $room->bookings_count }} bookings</span>
                                    <span>🚫 {{ $room->blocks_count }} blocks</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $room->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500">No room data available</p>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions Section -->
<div class="glass rounded-2xl p-8 animate-fade-in">
    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
        ⚡ Quick Actions
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Manage Rooms -->
        <a href="{{ route('admin.rooms.index') }}" class="group flex flex-col items-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 text-center group-hover:text-green-600 transition-colors duration-300">Manage Rooms</h4>
            <p class="text-sm text-gray-600 text-center mt-2">Add, edit, and manage meeting rooms</p>
        </a>

        <!-- Manage Bookings -->
        <a href="{{ route('admin.bookings') }}" class="group flex flex-col items-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 text-center group-hover:text-blue-600 transition-colors duration-300">Manage Bookings</h4>
            <p class="text-sm text-gray-600 text-center mt-2">View and manage all reservations</p>
        </a>

        <!-- Create Block -->
        <a href="{{ route('admin.blocks.create') }}" class="group flex flex-col items-center p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl hover:from-yellow-100 hover:to-orange-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 text-center group-hover:text-yellow-600 transition-colors duration-300">Create Block</h4>
            <p class="text-sm text-gray-600 text-center mt-2">Block rooms for maintenance</p>
        </a>

        <!-- View Blocks -->
        <a href="{{ route('admin.blocks') }}" class="group flex flex-col items-center p-6 bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl hover:from-red-100 hover:to-pink-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 text-center group-hover:text-red-600 transition-colors duration-300">View Blocks</h4>
            <p class="text-sm text-gray-600 text-center mt-2">See all blocked time slots</p>
        </a>
    </div>

    <!-- Additional Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Statistics -->
        <a href="{{ route('admin.statistics') }}" class="group flex items-center p-6 bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl hover:from-purple-100 hover:to-indigo-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">Statistics & Analytics</h4>
                <p class="text-sm text-gray-600 mt-1">View detailed usage statistics and reports</p>
            </div>
        </a>

        <!-- Add New Room -->
        <a href="{{ route('admin.rooms.create') }}" class="group flex items-center p-6 bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl hover:from-teal-100 hover:to-cyan-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-teal-600 transition-colors duration-300">Add New Room</h4>
                <p class="text-sm text-gray-600 mt-1">Create a new meeting room for booking</p>
            </div>
        </a>
    </div>
</div>
@endsection