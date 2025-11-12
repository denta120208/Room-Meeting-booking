@extends('layouts.app')

@section('content')
<!-- Statistics Header -->
<div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-700 text-white rounded-3xl mb-8 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="20" cy="20" r="2"/></g></svg>');"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-4 right-8 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float"></div>
    <div class="absolute bottom-4 left-8 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
    
    <div class="relative p-8 lg:p-12">
        <div class="flex items-center mb-4">
            <div class="w-20 h-20 bg-gradient-to-br from-white to-purple-100 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                    📊 Room Statistics & <span class="text-purple-200">Analytics</span>
                </h1>
                <p class="text-purple-100 text-lg">
                    Comprehensive room utilization and booking analytics
                </p>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-3">
            <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                Performance Insights
            </div>
            <div class="inline-flex items-center px-4 py-2 bg-blue-500 bg-opacity-80 rounded-lg text-white font-semibold">
                <div class="w-2 h-2 bg-blue-300 rounded-full mr-2 animate-pulse"></div>
                Real-time Data
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="glass rounded-2xl p-6 mb-8 animate-slide-up">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 flex items-center">
            🔍 Filter Statistics
        </h3>
    </div>
    
    <form method="GET" action="{{ route('admin.statistics') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
            <label for="room_id" class="block text-sm font-semibold text-gray-700 mb-2">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Select Room
            </label>
            <select name="room_id" id="room_id" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $selectedRoom && $selectedRoom->id == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Start Date
            </label>
            <input type="date" name="start_date" id="start_date" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" 
                   value="{{ request('start_date') }}">
        </div>
        
        <div>
            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                End Date
            </label>
            <input type="date" name="end_date" id="end_date" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" 
                   value="{{ request('end_date') }}">
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold transform hover:scale-105 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Update
            </button>
        </div>
    </form>
</div>

@if($selectedRoom && !empty($statistics))
    <!-- Statistics Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
        <!-- Total Bookings -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $statistics['total_bookings'] }}</h3>
            <p class="text-gray-600 text-sm">Total Bookings</p>
        </div>

        <!-- Confirmed -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up" style="animation-delay: 0.1s;">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $statistics['confirmed_bookings'] }}</h3>
            <p class="text-gray-600 text-sm">Confirmed</p>
        </div>

        <!-- Cancelled -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up" style="animation-delay: 0.2s;">
            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $statistics['cancelled_bookings'] }}</h3>
            <p class="text-gray-600 text-sm">Cancelled</p>
        </div>

        <!-- Total Blocks -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up" style="animation-delay: 0.3s;">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $statistics['total_blocks'] }}</h3>
            <p class="text-gray-600 text-sm">Total Blocks</p>
        </div>

        <!-- Success Rate -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up" style="animation-delay: 0.4s;">
            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $statistics['utilization_rate'] }}%</h3>
            <p class="text-gray-600 text-sm">Success Rate</p>
        </div>

        <!-- Capacity -->
        <div class="glass rounded-2xl p-6 text-center animate-slide-up" style="animation-delay: 0.5s;">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $selectedRoom->capacity }}</h3>
            <p class="text-gray-600 text-sm">Capacity</p>
        </div>
    </div>

    <!-- Details and Metrics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Room Details -->
        <div class="glass rounded-2xl p-6 animate-fade-in">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                🏢 {{ $selectedRoom->name }} - Room Details
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600">Description</span>
                    <span class="text-gray-900 font-medium">{{ $selectedRoom->description ?: 'No description' }}</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600">Capacity</span>
                    <span class="text-gray-900 font-medium">{{ $selectedRoom->capacity }} people</span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <span class="text-gray-600">Status</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $selectedRoom->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $selectedRoom->is_active ? '✅ Active' : '❌ Inactive' }}
                    </span>
                </div>
                
                @if($selectedRoom->amenities && count($selectedRoom->amenities) > 0)
                    <div class="py-3">
                        <span class="text-gray-600 block mb-2">Amenities</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($selectedRoom->amenities as $amenity)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800">
                                    {{ str_replace('_', ' ', ucfirst($amenity)) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Performance Metrics -->
        <div class="glass rounded-2xl p-6 animate-fade-in">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                📊 Performance Metrics
            </h3>
            
            <div class="space-y-6">
                <!-- Success Rate -->
                <div>
                    <div class="flex justify-content-between items-center mb-2">
                        <span class="text-gray-600">Booking Success Rate</span>
                        <span class="font-bold text-green-600">{{ $statistics['utilization_rate'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-500" style="width: {{ $statistics['utilization_rate'] }}%"></div>
                    </div>
                </div>
                
                @if($statistics['total_bookings'] > 0)
                    <!-- Cancellation Rate -->
                    <div>
                        <div class="flex justify-content-between items-center mb-2">
                            <span class="text-gray-600">Cancellation Rate</span>
                            <span class="font-bold text-red-600">{{ round(($statistics['cancelled_bookings'] / $statistics['total_bookings']) * 100, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-red-400 to-red-600 h-3 rounded-full transition-all duration-500" style="width: {{ round(($statistics['cancelled_bookings'] / $statistics['total_bookings']) * 100, 1) }}%"></div>
                        </div>
                    </div>
                @endif
                
                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-2 gap-6 text-center">
                        <div>
                            <div class="text-3xl font-bold text-blue-600 mb-1">{{ $statistics['confirmed_bookings'] }}</div>
                            <div class="text-sm text-gray-600">Successful Bookings</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-orange-600 mb-1">{{ $statistics['total_blocks'] }}</div>
                            <div class="text-sm text-gray-600">Maintenance Blocks</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="glass rounded-2xl p-16 text-center animate-fade-in">
        <div class="w-32 h-32 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-4">No Statistics Available</h3>
        <p class="text-gray-600 text-lg">Please select a room and date range to view statistics.</p>
    </div>
@endif
@endsection