@extends('layouts.app')

@section('content')
<!-- Hero Welcome Section -->
<div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 text-white rounded-3xl mb-8 overflow-hidden">
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
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">
                            Welcome back, <span class="text-yellow-300">{{ auth()->user()->name }}</span>! 👋
                        </h1>
                        <p class="text-blue-100 text-lg">
                            Ready to manage your meeting spaces? Let's make today productive!
                        </p>
                    </div>
                </div>
                
                @if(auth()->user()->isAdmin())
                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg text-white font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Admin Privileges
                    </div>
                @endif
            </div>
            
            <div class="hidden lg:block animate-scale-in">
                <div class="w-32 h-32 bg-gradient-to-br from-white to-blue-100 rounded-full flex items-center justify-center opacity-20">
                    <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Quick Book Card -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">Quick Book</h3>
        <p class="text-gray-600 mb-4 text-sm">Reserve a room in seconds</p>
        <a href="{{ route('bookings.create') }}" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 text-center font-medium transform hover:scale-105 block">
            Book Now
        </a>
    </div>

    <!-- Browse Rooms Card -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors duration-300">Browse Rooms</h3>
        <p class="text-gray-600 mb-4 text-sm">Explore available spaces</p>
        <a href="{{ route('rooms.index') }}" class="w-full bg-gradient-to-r from-green-600 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-green-700 hover:to-blue-700 transition-all duration-200 text-center font-medium transform hover:scale-105 block">
            View Rooms
        </a>
    </div>

    <!-- My Bookings Card -->
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors duration-300">My Bookings</h3>
        <p class="text-gray-600 mb-4 text-sm">Manage reservations</p>
        <a href="{{ route('bookings.index') }}" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 text-center font-medium transform hover:scale-105 block">
            View Bookings
        </a>
    </div>

    <!-- Admin Panel Card (if admin) -->
    @if(auth()->user()->isAdmin())
    <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-slide-up" style="animation-delay: 0.3s;">
        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-yellow-600 transition-colors duration-300">Admin Panel</h3>
        <p class="text-gray-600 mb-4 text-sm">Administrative tools</p>
        <a href="{{ route('admin.dashboard') }}" class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-lg hover:from-yellow-600 hover:to-orange-600 transition-all duration-200 text-center font-medium transform hover:scale-105 block">
            Admin Dashboard
        </a>
    </div>
    @endif
</div>

<!-- Recent Bookings Section -->
<div class="glass rounded-2xl p-6 mb-8 animate-fade-in">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-900">📅 Your Recent Bookings</h3>
        <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
            View All →
        </a>
    </div>
    
    @php
        $recentBookings = auth()->user()->bookings()->with('room')->orderBy('created_at', 'desc')->limit(5)->get();
    @endphp
    
    @if($recentBookings->count() > 0)
        <div class="overflow-hidden rounded-xl border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentBookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $booking->room->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-900 font-medium">{{ $booking->title }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    <div class="text-sm">
                                        <div class="font-medium">{{ $booking->start_time->format('M j, Y') }}</div>
                                        <div class="text-gray-500">{{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
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
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('bookings.show', $booking) }}" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        @if($booking->status === 'confirmed' && $booking->start_time > now())
                                            <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm font-medium" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-xl font-semibold text-gray-900 mb-2">No bookings yet</h4>
            <p class="text-gray-600 mb-6">Start by booking your first meeting room!</p>
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-medium transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Book Your First Room
            </a>
        </div>
    @endif
</div>
@endsection