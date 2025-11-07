@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Booking Details</h1>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to My Bookings</a>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $booking->title }}</h5>
                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }} fs-6">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Meeting Information</h6>
                        <p><strong>Title:</strong> {{ $booking->title }}</p>
                        @if($booking->description)
                            <p><strong>Description:</strong></p>
                            <p>{{ $booking->description }}</p>
                        @endif
                        <p><strong>Organizer:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Schedule & Location</h6>
                        <p><strong>Room:</strong> {{ $booking->room->name }}</p>
                        <p><strong>Date:</strong> {{ $booking->start_time->format('l, F j, Y') }}</p>
                        <p><strong>Start Time:</strong> {{ $booking->start_time->format('g:i A') }}</p>
                        <p><strong>End Time:</strong> {{ $booking->end_time->format('g:i A') }}</p>
                        <p><strong>Duration:</strong> {{ $booking->start_time->diffInHours($booking->end_time) }} hour(s)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Room Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Room Name:</strong> {{ $booking->room->name }}</p>
                        <p><strong>Capacity:</strong> {{ $booking->room->capacity }} people</p>
                        @if($booking->room->description)
                            <p><strong>Description:</strong> {{ $booking->room->description }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        @if($booking->room->amenities && count($booking->room->amenities) > 0)
                            <p><strong>Available Amenities:</strong></p>
                            <div class="row">
                                @foreach($booking->room->amenities as $amenity)
                                    <div class="col-12 mb-1">
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

        <!-- Booking Timeline -->
        <div class="card">
            <div class="card-header">
                <h5>Booking Timeline</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6>Booking Created</h6>
                            <p class="text-muted mb-0">{{ $booking->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($booking->status === 'cancelled')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-danger"></div>
                            <div class="timeline-content">
                                <h6>Booking Cancelled</h6>
                                <p class="text-muted mb-0">{{ $booking->updated_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>
                    @else
                        @if($booking->start_time > now())
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6>Meeting Scheduled</h6>
                                    <p class="text-muted mb-0">{{ $booking->start_time->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @elseif($booking->start_time <= now() && $booking->end_time >= now())
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6>Meeting in Progress</h6>
                                    <p class="text-muted mb-0">Started {{ $booking->start_time->format('g:i A') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6>Meeting Completed</h6>
                                    <p class="text-muted mb-0">Ended {{ $booking->end_time->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                @if($booking->status === 'confirmed' && $booking->start_time > now())
                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger w-100" 
                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                <i class="fas fa-times me-2"></i>Cancel Booking
                            </button>
                        </form>
                        
                        <a href="{{ route('rooms.show', $booking->room) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>View Room
                        </a>
                        
                        <a href="{{ route('bookings.create', ['room_id' => $booking->room->id]) }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Book Again
                        </a>
                    </div>
                @elseif($booking->status === 'cancelled')
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This booking has been cancelled.
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('bookings.create', ['room_id' => $booking->room->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create New Booking
                        </a>
                        
                        <a href="{{ route('rooms.show', $booking->room) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>View Room
                        </a>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        This meeting has {{ $booking->end_time < now() ? 'ended' : 'started' }}.
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('bookings.create', ['room_id' => $booking->room->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Book Again
                        </a>
                        
                        <a href="{{ route('rooms.show', $booking->room) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-2"></i>View Room
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h6>Booking Summary</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-12 mb-3">
                        <h4 class="text-{{ $booking->status === 'confirmed' ? 'success' : 'danger' }}">
                            {{ ucfirst($booking->status) }}
                        </h4>
                        <small>Current Status</small>
                    </div>
                    
                    @if($booking->status === 'confirmed')
                        <div class="col-6">
                            <h5 class="text-primary">
                                @if($booking->start_time > now())
                                    {{ $booking->start_time->diffForHumans() }}
                                @else
                                    Now
                                @endif
                            </h5>
                            <small>
                                @if($booking->start_time > now())
                                    Starts
                                @elseif($booking->end_time >= now())
                                    In Progress
                                @else
                                    Completed
                                @endif
                            </small>
                        </div>
                        <div class="col-6">
                            <h5 class="text-info">{{ $booking->start_time->diffInHours($booking->end_time) }}h</h5>
                            <small>Duration</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6>Contact Information</h6>
            </div>
            <div class="card-body">
                <p><strong>Organizer:</strong><br>{{ $booking->user->name }}</p>
                <p><strong>Email:</strong><br>{{ $booking->user->email }}</p>
                <p><strong>Booking ID:</strong><br>#{{ $booking->id }}</p>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -28px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}
</style>
@endsection