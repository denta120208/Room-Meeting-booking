@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard</h1>
        <p class="lead">Welcome to the Meeting Room Reservation System, {{ auth()->user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-header">Quick Book</div>
            <div class="card-body">
                <p class="card-text">Reserve a room quickly</p>
                <a href="{{ route('bookings.create') }}" class="btn btn-light">Book Now</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-header">Browse Rooms</div>
            <div class="card-body">
                <p class="card-text">View available rooms</p>
                <a href="{{ route('rooms.index') }}" class="btn btn-light">View Rooms</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-header">My Bookings</div>
            <div class="card-body">
                <p class="card-text">Manage your reservations</p>
                <a href="{{ route('bookings.index') }}" class="btn btn-light">View Bookings</a>
            </div>
        </div>
    </div>
    
    @if(auth()->user()->isAdmin())
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-header">Admin Panel</div>
            <div class="card-body">
                <p class="card-text">Administrative tools</p>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">Admin Dashboard</a>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <h3>Your Recent Bookings</h3>
        @php
            $recentBookings = auth()->user()->bookings()->with('room')->orderBy('created_at', 'desc')->limit(5)->get();
        @endphp
        
        @if($recentBookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Title</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $booking)
                            <tr>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->title }}</td>
                                <td>{{ $booking->start_time->format('M j, Y g:i A') }} - {{ $booking->end_time->format('g:i A') }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    @if($booking->status === 'confirmed' && $booking->start_time > now())
                                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                You haven't made any bookings yet. <a href="{{ route('bookings.create') }}">Book your first room!</a>
            </div>
        @endif
    </div>
</div>
@endsection