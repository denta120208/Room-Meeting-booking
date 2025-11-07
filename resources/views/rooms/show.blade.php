@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $room->name }}</h1>
            <div>
                <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary">Book This Room</a>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back to Rooms</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Room Details</h5>
                        <p><strong>Capacity:</strong> {{ $room->capacity }} people</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $room->is_active ? 'success' : 'danger' }}">
                                {{ $room->is_active ? 'Available' : 'Unavailable' }}
                            </span>
                        </p>
                        
                        @if($room->description)
                            <div class="mt-3">
                                <h6>Description</h6>
                                <p>{{ $room->description }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        @if($room->amenities && count($room->amenities) > 0)
                            <h6>Available Amenities</h6>
                            <div class="row">
                                @foreach($room->amenities as $amenity)
                                    <div class="col-6 mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        {{ str_replace('_', ' ', ucfirst($amenity)) }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Date Selection for Availability -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Check Availability</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('rooms.show', $room) }}">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <label for="date" class="form-label">Select Date</label>
                            <input type="date" class="form-control" id="date" name="date" 
                                   value="{{ $date->format('Y-m-d') }}" min="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Check Availability</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Available Time Slots -->
        @if(count($availableSlots) > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Available Time Slots - {{ $date->format('M j, Y') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($availableSlots as $slot)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <a href="{{ route('bookings.create', ['room_id' => $room->id, 'start_time' => $slot['start_datetime']->format('Y-m-d\TH:i'), 'end_time' => $slot['end_datetime']->format('Y-m-d\TH:i')]) }}" 
                                   class="btn btn-outline-success w-100">
                                    {{ $slot['start'] }} - {{ $slot['end'] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <h5>No Available Slots</h5>
                <p>No time slots are available for {{ $date->format('M j, Y') }}. Try selecting a different date.</p>
            </div>
        @endif

        <!-- Today's Bookings -->
        @if($todayBookings->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5>Today's Schedule - {{ $date->format('M j, Y') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Meeting Title</th>
                                    <th>Organizer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todayBookings as $booking)
                                    <tr>
                                        <td>
                                            {{ $booking->start_time->format('g:i A') }} - 
                                            {{ $booking->end_time->format('g:i A') }}
                                        </td>
                                        <td>{{ $booking->title }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'danger' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Quick Book</h5>
            </div>
            <div class="card-body">
                <p>Ready to book this room?</p>
                <div class="d-grid">
                    <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary">
                        <i class="fas fa-calendar-plus me-2"></i>Book Now
                    </a>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h6>Room Summary</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-12 mb-3">
                        <h4 class="text-primary">{{ $room->capacity }}</h4>
                        <small>Maximum Capacity</small>
                    </div>
                    <div class="col-6">
                        <h5 class="text-success">{{ count($availableSlots) }}</h5>
                        <small>Available Slots Today</small>
                    </div>
                    <div class="col-6">
                        <h5 class="text-info">{{ $todayBookings->count() }}</h5>
                        <small>Booked Today</small>
                    </div>
                </div>
            </div>
        </div>

        @if($room->amenities && count($room->amenities) > 0)
            <div class="card">
                <div class="card-header">
                    <h6>Amenities</h6>
                </div>
                <div class="card-body">
                    @foreach($room->amenities as $amenity)
                        <div class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection