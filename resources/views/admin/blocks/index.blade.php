@extends('layouts.app')

@section('content')
<!-- Blocks Header -->
<div class="relative bg-gradient-to-br from-red-600 via-orange-600 to-yellow-700 text-white rounded-3xl mb-8 overflow-hidden">
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
                    <div class="w-20 h-20 bg-gradient-to-br from-white to-orange-100 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            🚫 Room <span class="text-orange-200">Blocks</span>
                        </h1>
                        <p class="text-orange-100 text-lg">
                            Manage room blocks and maintenance schedules
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Block Management
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-red-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <div class="w-2 h-2 bg-red-300 rounded-full mr-2 animate-pulse"></div>
                        Active Restrictions
                    </div>
                </div>
            </div>
            
            <div class="mt-6 lg:mt-0 animate-scale-in">
                <a href="{{ route('admin.blocks.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Block
                </a>
            </div>
        </div>
    </div>
</div>

@if($blocks->count() > 0)
    <!-- Blocks List -->
    <div class="space-y-6 mb-8">
        @foreach($blocks as $block)
            <div class="group glass rounded-2xl p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 animate-slide-up">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <!-- Block Info -->
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <!-- Block Icon -->
                            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                </svg>
                            </div>
                            
                            <!-- Block Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="text-sm text-gray-500">#{{ $block->id }}</span>
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-300">
                                        {{ $block->reason }}
                                    </h3>
                                    @if($block->end_time > now())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            ⚠️ Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            ⏰ Expired
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="text-gray-600 mb-3">
                                    <div class="flex items-center space-x-1 text-sm">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $block->room->name }}</span>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>{{ $block->admin->name }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <div class="font-medium">{{ $block->start_time->format('M j, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $block->start_time->format('g:i A') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <div class="font-medium">{{ $block->end_time->format('M j, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $block->end_time->format('g:i A') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            @php
                                                $duration = $block->start_time->diffInHours($block->end_time);
                                                $days = floor($duration / 24);
                                                $hours = $duration % 24;
                                            @endphp
                                            @if($days > 0)
                                                {{ $days }}d {{ $hours }}h
                                            @else
                                                {{ $hours }}h
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex justify-end">
                        @if($block->end_time > now())
                            <form method="POST" action="{{ route('admin.blocks.destroy', $block) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 text-sm font-medium transform hover:scale-105" 
                                        onclick="return confirm('Are you sure you want to remove this block?')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Remove
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500 italic">Expired</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="glass rounded-2xl p-6">
        {{ $blocks->links() }}
    </div>
@else
    <!-- Empty State -->
    <div class="glass rounded-2xl p-16 text-center animate-fade-in">
        <div class="w-32 h-32 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-16 h-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
            </svg>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-4">No blocks found</h3>
        <p class="text-gray-600 text-lg mb-8">No room blocks have been created yet. Create the first block.</p>
        <a href="{{ route('admin.blocks.create') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-600 to-orange-600 text-white rounded-xl hover:from-red-700 hover:to-orange-700 transition-all duration-200 font-semibold transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Create First Block
        </a>
    </div>
@endif
@endsection