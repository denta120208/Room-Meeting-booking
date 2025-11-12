@extends('layouts.app')

@section('content')
<!-- Book a Room Header -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                            📅 Book a Meeting <span class="text-green-200">Room</span>
                        </h1>
                        <p class="text-green-100 text-lg">
                            Reserve the perfect space for your next meeting or event
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg text-white font-semibold backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Instant Booking
                    </div>
                    <div class="inline-flex items-center px-4 py-2 bg-blue-500 bg-opacity-80 rounded-lg text-white font-semibold">
                        <div class="w-2 h-2 bg-blue-300 rounded-full mr-2 animate-pulse"></div>
                        Available Now
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Form Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="glass rounded-2xl p-8 animate-slide-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                ✨ Create Your Booking
            </h2>
            
            <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                @csrf
                
                <!-- Room Selection -->
                <div>
                    <label for="room_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Select Room *
                    </label>
                    <select class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('room_id') border-red-500 @enderror" 
                            id="room_id" name="room_id" required>
                        <option value="">Choose a room...</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ (old('room_id', $selectedRoom?->id) == $room->id) ? 'selected' : '' }}>
                                {{ $room->name }} (Capacity: {{ $room->capacity }})
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meeting Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Meeting Title *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('title') border-red-500 @enderror" 
                           id="title" name="title" value="{{ old('title') }}" 
                           placeholder="Enter your meeting title..."
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Description (Optional)
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('description') border-red-500 @enderror" 
                              id="description" name="description" rows="4"
                              placeholder="Add any additional details about your meeting...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date & Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Start Date & Time *
                        </label>
                        <input type="datetime-local" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('start_time') border-red-500 @enderror" 
                               id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                        @error('start_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            End Date & Time *
                        </label>
                        <input type="datetime-local" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('end_time') border-red-500 @enderror" 
                               id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                        @error('end_time')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-blue-700 transition-all duration-200 font-semibold transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Create Booking
                    </button>
                    <a href="{{ route('bookings.index') }}" class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-xl hover:bg-gray-200 transition-all duration-200 font-semibold text-center flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1">
        @if(isset($selectedRoom) && $selectedRoom)
            <!-- Room Details Card -->
            <div class="glass rounded-2xl p-6 mb-6 animate-scale-in">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $selectedRoom->name }}</h3>
                </div>
                
                @if($selectedRoom->description)
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $selectedRoom->description }}</p>
                @endif
                
                <div class="flex items-center justify-center mb-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $selectedRoom->capacity }}</div>
                        <div class="text-sm text-gray-500">People</div>
                    </div>
                </div>
                
                @if($selectedRoom->amenities && count($selectedRoom->amenities) > 0)
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">✨ Amenities</h4>
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

            @if(isset($availableSlots) && count($availableSlots) > 0)
                <!-- Available Slots -->
                <div class="glass rounded-2xl p-6 animate-fade-in">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Available Today
                    </h4>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($availableSlots as $slot)
                            <button type="button" 
                                    class="px-3 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm font-medium" 
                                    onclick="selectTimeSlot('{{ $slot['start_datetime']->format('Y-m-d\TH:i') }}', '{{ $slot['end_datetime']->format('Y-m-d\TH:i') }}')">
                                {{ $slot['start'] }} - {{ $slot['end'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <!-- Help Card -->
            <div class="glass rounded-2xl p-6 text-center animate-fade-in">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Quick Tips</h4>
                <div class="text-sm text-gray-600 text-left space-y-2">
                    <p>• Select a room to see available time slots</p>
                    <p>• Bookings can be made up to 30 days in advance</p>
                    <p>• You can cancel bookings up to 1 hour before the start time</p>
                    <p>• All bookings are subject to approval</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function selectTimeSlot(startTime, endTime) {
    document.getElementById('start_time').value = startTime;
    document.getElementById('end_time').value = endTime;
    
    // Add visual feedback
    const startInput = document.getElementById('start_time');
    const endInput = document.getElementById('end_time');
    
    startInput.classList.add('border-green-500', 'bg-green-50');
    endInput.classList.add('border-green-500', 'bg-green-50');
    
    setTimeout(() => {
        startInput.classList.remove('border-green-500', 'bg-green-50');
        endInput.classList.remove('border-green-500', 'bg-green-50');
    }, 2000);
}

// Auto-update end time when start time changes (add 1 hour)
document.getElementById('start_time').addEventListener('change', function() {
    const startTime = new Date(this.value);
    if (startTime) {
        const endTime = new Date(startTime.getTime() + 60 * 60 * 1000); // Add 1 hour
        const endTimeString = endTime.toISOString().slice(0, 16);
        document.getElementById('end_time').value = endTimeString;
    }
});
</script>
@endpush