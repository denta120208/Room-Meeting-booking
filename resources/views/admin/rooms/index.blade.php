@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Room Management</h1>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">Add New Room</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($rooms->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Capacity</th>
                                    <th>Bookings</th>
                                    <th>Blocks</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>
                                            <strong>{{ $room->name }}</strong>
                                            @if($room->description)
                                                <br><small class="text-muted">{{ Str::limit($room->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $room->capacity }} people</td>
                                        <td>
                                            <span class="badge bg-info">{{ $room->bookings_count }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ $room->blocks_count }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $room->is_active ? 'success' : 'danger' }}">
                                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-outline-info">View</a>
                                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-outline-primary">Edit</a>
                                                
                                                <form method="POST" action="{{ route('admin.rooms.toggle-status', $room) }}" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-{{ $room->is_active ? 'warning' : 'success' }}">
                                                        {{ $room->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                
                                                <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" 
                                                            onclick="return confirm('Are you sure? This action cannot be undone.')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $rooms->links() }}
                @else
                    <div class="alert alert-info">
                        <h4>No rooms found</h4>
                        <p>Start by <a href="{{ route('admin.rooms.create') }}">adding your first room</a>.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection