@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Create Room Block</h1>
            <a href="{{ route('admin.blocks') }}" class="btn btn-secondary">Back to Blocks</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.blocks.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Select Room</label>
                        <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                            <option value="">Choose a room...</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id', request('room_id')) == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }} (Capacity: {{ $room->capacity }})
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Block</label>
                        <input type="text" class="form-control @error('reason') is-invalid @enderror" 
                               id="reason" name="reason" value="{{ old('reason') }}" 
                               placeholder="e.g., Maintenance, Renovation, Special Event" required>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Date & Time</label>
                                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" 
                                       id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_time" class="form-label">End Date & Time</label>
                                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" 
                                       id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> Creating this block will automatically cancel any existing bookings that conflict with the selected time period.
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Block</button>
                        <a href="{{ route('admin.blocks') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Block Guidelines</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-info-circle text-info"></i> Blocks prevent new bookings during the specified time</li>
                    <li><i class="fas fa-info-circle text-info"></i> Existing conflicting bookings will be automatically cancelled</li>
                    <li><i class="fas fa-info-circle text-info"></i> Use clear reasons like "Maintenance" or "Renovation"</li>
                    <li><i class="fas fa-info-circle text-info"></i> Blocks can be removed if no longer needed</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6>Common Block Reasons</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setReason('Scheduled Maintenance')">Scheduled Maintenance</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setReason('Renovation Work')">Renovation Work</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setReason('Equipment Upgrade')">Equipment Upgrade</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setReason('Special Event')">Special Event</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setReason('Deep Cleaning')">Deep Cleaning</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function setReason(reason) {
    document.getElementById('reason').value = reason;
}
</script>
@endpush
@endsection