@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>All Bookings Management</h1>
        <p class="lead">View and manage all user bookings</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Filter Bookings</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.bookings') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="room_id" class="form-control">
                                <option value="">All Rooms</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="From Date">
                        </div>
                        <div class="col-md-2">
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="To Date">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('admin.bookings') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Title</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}<br><small class="text-muted">{{ $booking->user->email }}</small></td>
                                <td>{{ $booking->room->name }}</td>
                                <td>
                                    <strong>{{ $booking->title }}</strong>
                                    @if($booking->description)
                                        <br><small class="text-muted">{{ Str::limit($booking->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    {{ $booking->start_time->format('M j, Y') }}<br>
                                    <small class="text-muted">{{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->created_at->format('M j, Y') }}</td>
                                <td>
                                    @if($booking->status === 'confirmed')
                                        <form method="POST" action="{{ route('admin.bookings.cancel', $booking) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $bookings->appends(request()->query())->links() }}
        @else
            <div class="alert alert-info">
                <h4>No bookings found</h4>
                <p>No bookings match your current filters.</p>
            </div>
        @endif
    </div>
</div>
@endsection