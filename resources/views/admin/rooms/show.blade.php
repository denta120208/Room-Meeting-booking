@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $room->name }}</h1>
            <div>
                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary">Edit Room</a>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Back to Rooms</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Room Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $room->name }}</p>
                        <p><strong>Capacity:</strong> {{ $room->capacity }} people</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $room->is_active ? 'success' : 'danger' }}">
                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Bookings:</strong> {{ $room->bookings->count() }}</p>
                        <p><strong>Total Blocks:</strong> {{ $room->blocks->count() }}</p>
                        <p><strong>Created:</strong> {{ $room->created_at->format('M j, Y') }}</p>
                    </div>
                </div>
                
                @if($room->description)
                    <div class="mt-3">
                        <p><strong>Description:</strong></p>
                        <p>{{ $room->description }}</p>
                    </div>
                @endif

                @if($room->amenities && count($room->amenities) > 0)
                    <div class="mt-3">
                        <p><strong>Amenities:</strong></p>
                        <div>
                            @foreach($room->amenities as $amenity)
                                <span class="badge bg-secondary me-1 mb-1">{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Recent Bookings</h5>
            </div>
            <div class="card-body">
                @if($room->bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room->bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->title }}</td>
                                        <td>
                                            {{ $booking->start_time->format('M j, Y') }}<br>
                                            <small class="text-muted">{{ $booking->start_time->format('g:i A') }} - {{ $booking->end_time->format('g:i A') }}</small>
                                        </td>
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
                    <p class="text-muted">No bookings found for this room.</p>
                @endif
            </div>
        </div>

        @if($room->blocks->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5>Recent Blocks</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Admin</th>
                                    <th>Reason</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room->blocks as $block)
                                    <tr>
                                        <td>{{ $block->admin->name }}</td>
                                        <td>{{ $block->reason }}</td>
                                        <td>
                                            {{ $block->start_time->format('M j, Y') }}<br>
                                            <small class="text-muted">{{ $block->start_time->format('g:i A') }} - {{ $block->end_time->format('g:i A') }}</small>
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

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary">Edit Room</a>
                    
                    <form method="POST" action="{{ route('admin.rooms.toggle-status', $room) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-{{ $room->is_active ? 'warning' : 'success' }}">
                            {{ $room->is_active ? 'Deactivate' : 'Activate' }} Room
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.blocks.create', ['room_id' => $room->id]) }}" class="btn btn-outline-warning">
                        Create Block
                    </a>
                    
                    <hr>
                    
                    <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" 
                          onsubmit="return confirm('Are you sure? This will permanently delete the room and cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete Room</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6>Room Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-12 mb-3">
                        <h4 class="text-primary">{{ $room->bookings()->where('status', 'confirmed')->count() }}</h4>
                        <small>Confirmed Bookings</small>
                    </div>
                    <div class="col-6">
                        <h5 class="text-success">{{ $room->bookings()->where('status', 'confirmed')->whereDate('start_time', '>=', now())->count() }}</h5>
                        <small>Upcoming</small>
                    </div>
                    <div class="col-6">
                        <h5 class="text-danger">{{ $room->bookings()->where('status', 'cancelled')->count() }}</h5>
                        <small>Cancelled</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection