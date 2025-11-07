@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Room Statistics & Analytics</h1>
        <p class="lead">Comprehensive room utilization and booking analytics</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Filter Statistics</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.statistics') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="room_id" class="form-label">Select Room</label>
                            <select name="room_id" id="room_id" class="form-control">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $selectedRoom && $selectedRoom->id == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($selectedRoom && !empty($statistics))
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $selectedRoom->name }} - Statistics Summary</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-2">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h3>{{ $statistics['total_bookings'] }}</h3>
                                <p class="mb-0">Total Bookings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h3>{{ $statistics['confirmed_bookings'] }}</h3>
                                <p class="mb-0">Confirmed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h3>{{ $statistics['cancelled_bookings'] }}</h3>
                                <p class="mb-0">Cancelled</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h3>{{ $statistics['total_blocks'] }}</h3>
                                <p class="mb-0">Total Blocks</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h3>{{ $statistics['utilization_rate'] }}%</h3>
                                <p class="mb-0">Success Rate</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary text-white">
                            <div class="card-body">
                                <h3>{{ $selectedRoom->capacity }}</h3>
                                <p class="mb-0">Capacity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Room Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $selectedRoom->name }}</p>
                <p><strong>Description:</strong> {{ $selectedRoom->description ?: 'No description' }}</p>
                <p><strong>Capacity:</strong> {{ $selectedRoom->capacity }} people</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $selectedRoom->is_active ? 'success' : 'danger' }}">
                        {{ $selectedRoom->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                
                @if($selectedRoom->amenities && count($selectedRoom->amenities) > 0)
                    <p><strong>Amenities:</strong></p>
                    <div>
                        @foreach($selectedRoom->amenities as $amenity)
                            <span class="badge bg-secondary me-1">{{ str_replace('_', ' ', ucfirst($amenity)) }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Performance Metrics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Booking Success Rate</span>
                        <span><strong>{{ $statistics['utilization_rate'] }}%</strong></span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ $statistics['utilization_rate'] }}%"></div>
                    </div>
                </div>
                
                @if($statistics['total_bookings'] > 0)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Cancellation Rate</span>
                            <span><strong>{{ round(($statistics['cancelled_bookings'] / $statistics['total_bookings']) * 100, 1) }}%</strong></span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: {{ round(($statistics['cancelled_bookings'] / $statistics['total_bookings']) * 100, 1) }}%"></div>
                        </div>
                    </div>
                @endif
                
                <hr>
                
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $statistics['confirmed_bookings'] }}</h4>
                        <small>Successful Bookings</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-warning">{{ $statistics['total_blocks'] }}</h4>
                        <small>Maintenance Blocks</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <h4>No Statistics Available</h4>
            <p>Please select a room and date range to view statistics.</p>
        </div>
    </div>
</div>
@endif
@endsection