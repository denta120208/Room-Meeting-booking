@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Meeting Rooms</h1>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">Book a Room</a>
        </div>
    </div>
</div>

<div class="row">
    @forelse($rooms as $room)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ $room->description }}</p>
                    
                    <div class="mb-2">
                        <strong>Capacity:</strong> {{ $room->capacity }} people
                    </div>
                    
                    @if($room->amenities)
                        <div class="mb-3">
                            <strong>Amenities:</strong>
                            <div class="mt-1">
                                @foreach($room->amenities as $amenity)
                                    <span class="badge bg-secondary me-1">{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-primary">View Details</a>
                        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary">Book This Room</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                No rooms are currently available.
            </div>
        </div>
    @endforelse
</div>
@endsection