@extends('layouts.app')

@section('content')
<!-- Add Room Header -->
<div class="relative bg-gradient-to-br from-green-600 via-blue-600 to-purple-700 text-white rounded-3xl mb-8 overflow-hidden">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            ➕ Add New <span class="text-green-200">Room</span>
                        </h1>
                        <p class="text-green-100 text-lg">
                            Create a new meeting room for your organization
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Room Setup
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-blue-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <div class="w-2 h-2 bg-blue-300 rounded-full mr-2 animate-pulse"></div>
                        Quick Configuration
                    </div>
                </div>
            </div>
            
            <div class="mt-6 lg:mt-0 animate-scale-in">
                <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Rooms
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="glass rounded-2xl p-8 animate-slide-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                ✨ Room Configuration
            </h2>
            
            <form method="POST" action="{{ route('admin.rooms.store') }}" class="space-y-6">
                @csrf
                
                <!-- Room Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Room Name *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('name') border-red-500 @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           placeholder="e.g., Conference Room A, Boardroom, Training Center..."
                           required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('description') border-red-500 @enderror" 
                              id="description" name="description" rows="4"
                              placeholder="Describe the room's features, location, or special characteristics...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Capacity (number of people) *
                    </label>
                    <input type="number" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('capacity') border-red-500 @enderror" 
                           id="capacity" name="capacity" value="{{ old('capacity') }}" 
                           min="1" max="500"
                           placeholder="e.g., 8, 12, 50..."
                           required>
                    @error('capacity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amenities -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        Amenities
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                            $availableAmenities = [
                                'projector' => ['label' => 'Projector', 'icon' => '📽️'],
                                'whiteboard' => ['label' => 'Whiteboard', 'icon' => '📝'],
                                'video_conference' => ['label' => 'Video Conference', 'icon' => '📹'],
                                'coffee_station' => ['label' => 'Coffee Station', 'icon' => '☕'],
                                'tv_screen' => ['label' => 'TV Screen', 'icon' => '📺'],
                                'phone' => ['label' => 'Phone', 'icon' => '☎️'],
                                'premium_furniture' => ['label' => 'Premium Furniture', 'icon' => '🪑'],
                                'multiple_screens' => ['label' => 'Multiple Screens', 'icon' => '🖥️'],
                                'training_setup' => ['label' => 'Training Setup', 'icon' => '🎓'],
                                'microphone' => ['label' => 'Microphone', 'icon' => '🎤'],
                                'air_conditioning' => ['label' => 'Air Conditioning', 'icon' => '❄️'],
                                'wifi' => ['label' => 'WiFi', 'icon' => '📶']
                            ];
                        @endphp
                        
                        @foreach($availableAmenities as $key => $amenity)
                            <label class="relative flex items-center p-3 rounded-xl border-2 border-gray-200 cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition-all duration-200">
                                <input class="sr-only peer" type="checkbox" name="amenities[]" 
                                       value="{{ $key }}" id="amenity_{{ $key }}"
                                       {{ in_array($key, old('amenities', [])) ? 'checked' : '' }}>
                                <div class="peer-checked:bg-blue-600 peer-checked:border-blue-600 border-2 border-gray-300 rounded w-5 h-5 flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2 text-lg">{{ $amenity['icon'] }}</span>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-blue-700">{{ $amenity['label'] }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Active Status -->
                <div class="border-t border-gray-200 pt-6">
                    <label class="relative flex items-center p-4 rounded-xl border-2 border-green-200 bg-green-50 cursor-pointer hover:bg-green-100 transition-all duration-200">
                        <input class="sr-only peer" type="checkbox" name="is_active" id="is_active" 
                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <div class="peer-checked:bg-green-600 peer-checked:border-green-600 border-2 border-green-400 rounded w-6 h-6 flex items-center justify-center mr-4">
                            <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-green-800 font-semibold">✅ Room is active and available for booking</div>
                            <div class="text-green-600 text-sm">Users will be able to see and book this room</div>
                        </div>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-blue-700 transition-all duration-200 font-semibold transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Create Room
                    </button>
                    <a href="{{ route('admin.rooms.index') }}" class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-xl hover:bg-gray-200 transition-all duration-200 font-semibold text-center flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Sidebar Guidelines -->
    <div class="lg:col-span-1">
        <div class="glass rounded-2xl p-6 animate-scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                📋 Room Guidelines
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                    <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Choose a descriptive name</div>
                        <div class="text-sm text-gray-600">Use clear, identifiable names for easy recognition</div>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                    <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Set realistic capacity</div>
                        <div class="text-sm text-gray-600">Base capacity on actual room size and comfort</div>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg">
                    <div class="w-6 h-6 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Select all amenities</div>
                        <div class="text-sm text-gray-600">Include all available equipment and features</div>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                    <div class="w-6 h-6 bg-yellow-600 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Active rooms are visible</div>
                        <div class="text-sm text-gray-600">Only active rooms appear in user booking lists</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection