@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>My Bookings</h1>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">New Booking</a>
        </div>
    </div>
</div>

@if($bookings->count() > 0)
    <div class="row">
        <div class="col-12">
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
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->room->name }}</td>
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
                                <td>
                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    @if($booking->status === 'confirmed' && $booking->start_time > now())
                                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $bookings->links() }}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h4>No bookings found</h4>
                <p>You haven't made any bookings yet. <a href="{{ route('bookings.create') }}">Create your first booking!</a></p>
            </div>
        </div>
    </div>
@endif
@endsection