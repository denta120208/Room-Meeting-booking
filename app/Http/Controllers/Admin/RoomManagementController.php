<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomManagementController extends Controller
{
    /**
     * Display a listing of rooms
     */
    public function index()
    {
        $rooms = Room::withCount(['bookings', 'blocks'])->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created room
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $room = Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'amenities' => $request->amenities ?? [],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room created successfully!');
    }

    /**
     * Display the specified room
     */
    public function show(Room $room)
    {
        $room->load(['bookings' => function($query) {
            $query->with('user')->orderBy('start_time', 'desc')->limit(10);
        }, 'blocks' => function($query) {
            $query->with('admin')->orderBy('start_time', 'desc')->limit(5);
        }]);

        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'amenities' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $room->update([
            'name' => $request->name,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'amenities' => $request->amenities ?? [],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully!');
    }

    /**
     * Remove the specified room
     */
    public function destroy(Room $room)
    {
        // Check if room has future bookings
        $futureBookings = $room->bookings()
            ->where('start_time', '>', now())
            ->where('status', 'confirmed')
            ->count();

        if ($futureBookings > 0) {
            return back()->withErrors(['error' => 'Cannot delete room with future bookings. Please cancel them first.']);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully!');
    }

    /**
     * Toggle room status
     */
    public function toggleStatus(Room $room)
    {
        $room->update(['is_active' => !$room->is_active]);
        
        $status = $room->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Room {$status} successfully!");
    }
}
