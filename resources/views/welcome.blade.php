@extends('layouts.app')

@section('content')
<div class="hero-section bg-primary text-white py-5 mb-5" style="margin-top: -1.5rem;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">Meeting Room Reservation System</h1>
                <p class="lead">Book meeting rooms effortlessly with our smart reservation system. Find the perfect space for your team meetings, presentations, and collaborative sessions.</p>
                
                @guest
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg me-3">Login</a>
                        <a href="{{ route('admin') }}" class="btn btn-warning btn-lg">Admin Panel</a>
                    </div>
                @else
                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-3">Go to Dashboard</a>
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-light btn-lg">Book a Room</a>
                    </div>
                @endguest
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="fas fa-building" style="font-size: 8rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center mb-5">
            <h2>Why Choose Our System?</h2>
            <p class="lead text-muted">Streamline your meeting room booking process with our intuitive and powerful features.</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-calendar-check text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Easy Booking</h5>
                    <p class="card-text">Book meeting rooms in just a few clicks. Check availability, select time slots, and confirm your reservation instantly.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-clock text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Real-time Availability</h5>
                    <p class="card-text">See real-time room availability and avoid double bookings with our smart conflict detection system.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-users-cog text-info" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Admin Control</h5>
                    <p class="card-text">Comprehensive admin panel for managing bookings, blocking rooms, and generating utilization reports.</p>
                </div>
            </div>
        </div>
    </div>

    @php
        $rooms = App\Models\Room::active()->limit(3)->get();
    @endphp

    @if($rooms->count() > 0)
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2>Available Meeting Rooms</h2>
            <p class="text-muted">Choose from our selection of well-equipped meeting spaces</p>
        </div>
    </div>

    <div class="row mb-5">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ Str::limit($room->description, 80) }}</p>
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="fas fa-users"></i> Capacity: {{ $room->capacity }} people
                        </small>
                    </div>
                    @if($room->amenities && count($room->amenities) > 0)
                        <div class="mb-3">
                            @foreach(array_slice($room->amenities, 0, 3) as $amenity)
                                <span class="badge bg-secondary me-1">{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                            @endforeach
                            @if(count($room->amenities) > 3)
                                <span class="badge bg-light text-dark">+{{ count($room->amenities) - 3 }} more</span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent">
                    @auth
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary btn-sm">Book Now</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @auth
    <div class="text-center mb-5">
        <a href="{{ route('rooms.index') }}" class="btn btn-outline-primary btn-lg">View All Rooms</a>
    </div>
    @endauth
    @endif

    <div class="row bg-light py-5 mb-4" style="margin-left: -15px; margin-right: -15px;">
        <div class="col-lg-8 offset-lg-2 text-center">
            <h2>Get Started Today</h2>
            <p class="lead">Join our meeting room reservation system and experience seamless booking management.</p>
            
            @guest
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Create Account</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg me-3">Sign In</a>
                    <a href="{{ route('admin') }}" class="btn btn-warning btn-lg">Admin Access</a>
                </div>
                
                <div class="mt-4 p-3 bg-light rounded">
                    <h6>Demo Credentials:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Admin:</strong><br>
                            Email: admin@example.com<br>
                            Password: password
                        </div>
                        <div class="col-md-6">
                            <strong>User:</strong><br>
                            Email: test@example.com<br>
                            Password: password
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-4">
                    <p class="mb-3">Welcome back, {{ auth()->user()->name }}!</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-3">Dashboard</a>
                    <a href="{{ route('bookings.create') }}" class="btn btn-success btn-lg">Book a Room</a>
                </div>
            @endguest
        </div>
    </div>
</div>

<style>
.hero-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection