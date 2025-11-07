@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit Room: {{ $room->name }}</h1>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Back to Rooms</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.rooms.update', $room) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $room->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $room->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity (number of people)</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                               id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amenities</label>
                        <div class="row">
                            @php
                                $availableAmenities = [
                                    'projector' => 'Projector',
                                    'whiteboard' => 'Whiteboard',
                                    'video_conference' => 'Video Conference',
                                    'coffee_station' => 'Coffee Station',
                                    'tv_screen' => 'TV Screen',
                                    'phone' => 'Phone',
                                    'premium_furniture' => 'Premium Furniture',
                                    'multiple_screens' => 'Multiple Screens',
                                    'training_setup' => 'Training Setup',
                                    'microphone' => 'Microphone',
                                    'air_conditioning' => 'Air Conditioning',
                                    'wifi' => 'WiFi'
                                ];
                                $roomAmenities = old('amenities', $room->amenities ?? []);
                            @endphp
                            
                            @foreach($availableAmenities as $key => $label)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="amenity_{{ $key }}" name="amenities[]" value="{{ $key }}"
                                               {{ in_array($key, $roomAmenities) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="amenity_{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Room is active and available for booking
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Room</button>
                        <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-info">View Room</a>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Room Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $room->bookings()->count() }}</h4>
                        <small>Total Bookings</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-warning">{{ $room->blocks()->count() }}</h4>
                        <small>Total Blocks</small>
                    </div>
                </div>
                
                <hr>
                
                <div class="text-center">
                    <span class="badge bg-{{ $room->is_active ? 'success' : 'danger' }} fs-6">
                        {{ $room->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-outline-info btn-sm">View Details</a>
                    
                    <form method="POST" action="{{ route('admin.rooms.toggle-status', $room) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-{{ $room->is_active ? 'warning' : 'success' }} btn-sm w-100">
                            {{ $room->is_active ? 'Deactivate' : 'Activate' }} Room
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection