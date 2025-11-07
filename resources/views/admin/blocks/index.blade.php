@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Room Blocks</h1>
                <p class="lead">Manage room blocks and maintenance schedules</p>
            </div>
            <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary">Create New Block</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($blocks->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room</th>
                            <th>Reason</th>
                            <th>Admin</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blocks as $block)
                            <tr>
                                <td>#{{ $block->id }}</td>
                                <td>{{ $block->room->name }}</td>
                                <td>{{ $block->reason }}</td>
                                <td>{{ $block->admin->name }}</td>
                                <td>
                                    {{ $block->start_time->format('M j, Y') }}<br>
                                    <small class="text-muted">{{ $block->start_time->format('g:i A') }}</small>
                                </td>
                                <td>
                                    {{ $block->end_time->format('M j, Y') }}<br>
                                    <small class="text-muted">{{ $block->end_time->format('g:i A') }}</small>
                                </td>
                                <td>
                                    @php
                                        $duration = $block->start_time->diffInHours($block->end_time);
                                        $days = floor($duration / 24);
                                        $hours = $duration % 24;
                                    @endphp
                                    @if($days > 0)
                                        {{ $days }}d {{ $hours }}h
                                    @else
                                        {{ $hours }}h
                                    @endif
                                </td>
                                <td>
                                    @if($block->end_time > now())
                                        <span class="badge bg-warning">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    @if($block->end_time > now())
                                        <form method="POST" action="{{ route('admin.blocks.destroy', $block) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to remove this block?')">
                                                Remove
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Expired</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $blocks->links() }}
        @else
            <div class="alert alert-info">
                <h4>No blocks found</h4>
                <p>No room blocks have been created yet. <a href="{{ route('admin.blocks.create') }}">Create the first block</a>.</p>
            </div>
        @endif
    </div>
</div>
@endsection