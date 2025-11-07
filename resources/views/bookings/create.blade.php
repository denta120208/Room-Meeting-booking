@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>Book a Meeting Room</h1>
        
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            
            <div class="mb-3">
                <label for="room_id" class="form-label">Select Room</label>
                <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                    <option value="">Choose a room...</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ (old('room_id', $selectedRoom?->id) == $room->id) ? 'selected' : '' }}>
                            {{ $room->name }} (Capacity: {{ $room->capacity }})
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Meeting Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Date & Time</label>
                        <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" 
                               id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Date & Time</label>
                        <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" 
                               id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Booking</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    
    <div class="col-md-4">
        @if($selectedRoom)
            <div class="card">
                <div class="card-header">
                    <h5>{{ $selectedRoom->name }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ $selectedRoom->description }}</p>
                    <p><strong>Capacity:</strong> {{ $selectedRoom->capacity }} people</p>
                    
                    @if($selectedRoom->amenities)
                        <p><strong>Amenities:</strong></p>
                        <div>
                            @foreach($selectedRoom->amenities as $amenity)
                                <span class="badge bg-secondary me-1">{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @if(count($availableSlots) > 0)
                <div class="card mt-3">
                    <div class="card-header">
                        <h6>Available Slots for {{ $selectedDate->format('M j, Y') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($availableSlots as $slot)
                                <div class="col-6 mb-2">
                                    <button type="button" class="btn btn-sm btn-outline-success w-100" 
                                            onclick="selectTimeSlot('{{ $slot['start_datetime']->format('Y-m-d\TH:i') }}', '{{ $slot['end_datetime']->format('Y-m-d\TH:i') }}')">
                                        {{ $slot['start'] }} - {{ $slot['end'] }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function selectTimeSlot(startTime, endTime) {
    document.getElementById('start_time').value = startTime;
    document.getElementById('end_time').value = endTime;
}
</script>
@endpush