@extends('layouts.app')

@section('content')
<!-- Admin Rooms Header -->
<div class="relative bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white rounded-3xl mb-8 overflow-hidden">
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
                    <div class="w-20 h-20 bg-gradient-to-br from-white to-green-100 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            🏢 Room <span class="text-green-200">Management</span>
                        </h1>
                        <p class="text-green-100 text-lg">
                            Manage meeting rooms, capacities, and availability settings
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Space Management
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-yellow-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Full Control
                    </div>
                </div>
            </div>
            
            <div class="mt-6 lg:mt-0 animate-scale-in">
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Room
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Rooms Grid -->
<div class="glass rounded-2xl overflow-hidden mb-8 animate-fade-in">
    @if($rooms->count() > 0)
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    🏢 All Rooms <span class="ml-3 text-sm font-normal text-gray-500">({{ $rooms->count() }} rooms)</span>
                </h3>
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 font-medium transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Room
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @foreach($rooms as $room)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden animate-slide-up">
                    <!-- Room Header -->
                    <div class="h-32 bg-gradient-to-br from-green-400 via-blue-500 to-purple-600 relative">
                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $room->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $room->is_active ? '✅ Active' : '❌ Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Room Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors duration-300">
                            {{ $room->name }}
                        </h3>
                        
                        @if($room->description)
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                {{ Str::limit($room->description, 100) }}
                            </p>
                        @endif
                        
                        <!-- Room Stats -->
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-lg font-bold text-gray-900">{{ $room->capacity }}</div>
                                <div class="text-xs text-gray-500">Capacity</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="text-lg font-bold text-gray-900">{{ $room->bookings_count ?? 0 }}</div>
                                <div class="text-xs text-gray-500">Bookings</div>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                </div>
                                <div class="text-lg font-bold text-gray-900">{{ $room->blocks_count ?? 0 }}</div>
                                <div class="text-xs text-gray-500">Blocks</div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.rooms.show', $room) }}" class="flex-1 px-3 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 text-center text-sm font-medium">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                            
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="flex-1 px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 text-center text-sm font-medium transform hover:scale-105">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                        </div>
                        
                        <!-- Additional Actions -->
                        <div class="flex gap-2 mt-3">
                            <form method="POST" action="{{ route('admin.rooms.toggle-status', $room) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full px-3 py-2 {{ $room->is_active ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }} rounded-lg transition-colors duration-200 text-sm font-medium">
                                    {{ $room->is_active ? '⏸️ Deactivate' : '▶️ Activate' }}
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full px-3 py-2 bg-red-100 text-red-800 hover:bg-red-200 rounded-lg transition-colors duration-200 text-sm font-medium" 
                                        onclick="return confirm('Are you sure? This action cannot be undone.')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $rooms->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h4 class="text-2xl font-bold text-gray-900 mb-2">No rooms found</h4>
            <p class="text-gray-600 mb-6">Start building your meeting space empire by adding your first room!</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 font-medium transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Your First Room
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