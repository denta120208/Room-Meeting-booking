@extends('layouts.app')

@section('content')
<!-- Admin Bookings Header -->
<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 text-white rounded-3xl mb-8 overflow-hidden">
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
                    <div class="w-20 h-20 bg-gradient-to-br from-white to-blue-100 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            📅 Bookings <span class="text-blue-200">Management</span>
                        </h1>
                        <p class="text-blue-100 text-lg">
                            View, filter, and manage all user reservations in one place
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        All Reservations
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-green-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <div class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></div>
                        Real-time Updates
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block animate-scale-in">
                <div class="w-32 h-32 bg-gradient-to-br from-white to-blue-100 rounded-full flex items-center justify-center opacity-30 shadow-2xl">
                    <svg class="w-20 h-20 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Advanced Filters -->
<div class="glass rounded-2xl p-6 mb-8 animate-slide-up">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900 flex items-center">
            🔍 Advanced Filters
        </h3>
        <div class="text-sm text-gray-500">
            Filter and search through all bookings
        </div>
    </div>
    
    <form method="GET" action="{{ route('admin.bookings') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Room Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Room</label>
                <select name="room_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                    <option value="">All Rooms</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                    <option value="">All Status</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                </select>
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
            </div>

            <!-- Date To -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col space-y-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Actions</label>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-3 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium transform hover:scale-105 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.bookings') }}" class="w-full bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium text-center">
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Bookings Table -->
<div class="glass rounded-2xl overflow-hidden mb-8 animate-fade-in">
    @if($bookings->count() > 0)
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                📋 All Bookings <span class="ml-3 text-sm font-normal text-gray-500">({{ $bookings->total() }} total)</span>
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Event Details</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- Booking ID -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">#{{ $booking->id }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Created: {{ $booking->created_at->format('M j') }}
                                    </div>
                                </div>
                            </td>
                            
                            <!-- User Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-semibold text-sm">{{ substr($booking->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $booking->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Room -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-400 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="font-medium text-gray-900">{{ $booking->room->name }}</div>
                                </div>
                            </td>
                            
                            <!-- Event Details -->
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $booking->title }}</div>
                                    @if($booking->description)
                                        <div class="text-sm text-gray-600 mt-1">{{ Str::limit($booking->description, 60) }}</div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Schedule -->
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900">{{ $booking->start_time->format('M j, Y') }}</div>
                                    <div class="text-gray-600">
                                        🕐 {{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Duration: {{ $booking->start_time->diffInHours($booking->end_time) }}h {{ $booking->start_time->diffInMinutes($booking->end_time) % 60 }}m
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Status -->
                            <td class="px-6 py-4">
                                @php
                                    $statusConfig = [
                                        'confirmed' => ['bg-green-100 text-green-800', '✅'],
                                        'cancelled' => ['bg-red-100 text-red-800', '❌'],
                                        'pending' => ['bg-yellow-100 text-yellow-800', '⏳']
                                    ];
                                    $config = $statusConfig[$booking->status] ?? ['bg-gray-100 text-gray-800', '❓'];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config[0] }}">
                                    {{ $config[1] }} {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                @if($booking->status === 'confirmed')
                                    <form method="POST" action="{{ route('admin.bookings.cancel', $booking) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm font-medium" 
                                                onclick="return confirm('Are you sure you want to cancel this booking?')">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm text-gray-400 italic">No actions available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-2xl font-bold text-gray-900 mb-2">No bookings found</h4>
            <p class="text-gray-600 mb-6">No bookings match your current filters. Try adjusting your search criteria.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.bookings') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Clear Filters
                </a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    @endif
</div>
@endsection