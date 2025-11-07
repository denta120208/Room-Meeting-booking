@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Admin Dashboard</h1>
        <p class="lead">Welcome to the administrative panel, {{ auth()->user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-2">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h3>{{ $totalRooms }}</h3>
                <p>Total Rooms</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h3>{{ $activeRooms }}</h3>
                <p>Active Rooms</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h3>{{ $totalBookings }}</h3>
                <p>Total Bookings</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h3>{{ $todayBookings }}</h3>
                <p>Today's Bookings</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card text-white bg-secondary">
            <div class="card-body text-center">
                <h3>{{ $upcomingBookings }}</h3>
                <p>Upcoming</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="card text-white bg-dark">
            <div class="card-body text-center">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Bookings</h5>
            </div>
            <div class="card-body">
                @if($recentBookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Room</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->room->name }}</td>
                                        <td>{{ $booking->start_time->format('M j') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No recent bookings</p>
                @endif
                
                <div class="mt-3">
                    <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-primary">View All Bookings</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Room Statistics</h5>
            </div>
            <div class="card-body">
                @if($roomStats->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Bookings</th>
                                    <th>Blocks</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roomStats as $room)
                                    <tr>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->bookings_count }}</td>
                                        <td>{{ $room->blocks_count }}</td>
                                        <td>
                                            <span class="badge bg-{{ $room->is_active ? 'success' : 'danger' }}">
                                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No room data available</p>
                @endif
                
                <div class="mt-3">
                    <a href="{{ route('admin.statistics') }}" class="btn btn-sm btn-primary">Detailed Statistics</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-success btn-lg w-100 mb-2">
                            <i class="fas fa-door-open"></i><br>
                            Manage Rooms
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.bookings') }}" class="btn btn-outline-primary btn-lg w-100 mb-2">
                            <i class="fas fa-calendar"></i><br>
                            Manage Bookings
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.blocks.create') }}" class="btn btn-outline-warning btn-lg w-100 mb-2">
                            <i class="fas fa-ban"></i><br>
                            Create Block
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.blocks') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                            <i class="fas fa-lock"></i><br>
                            View Blocks
                        </a>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="{{ route('admin.statistics') }}" class="btn btn-outline-info btn-lg w-100 mb-2">
                            <i class="fas fa-chart-bar"></i><br>
                            Statistics
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.rooms.create') }}" class="btn btn-outline-secondary btn-lg w-100 mb-2">
                            <i class="fas fa-plus"></i><br>
                            Add New Room
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection