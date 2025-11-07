<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of rooms
     */
    public function index()
    {
        $rooms = Room::active()->get();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Display the specified room
     */
    public function show(Room $room, Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $availableSlots = $this->bookingService->getAvailableSlots($room->id, $date);
        
        // Get today's bookings for the room
        $todayBookings = $room->bookings()
            ->whereDate('start_time', $date)
            ->where('status', 'confirmed')
            ->orderBy('start_time')
            ->get();

        return view('rooms.show', compact('room', 'date', 'availableSlots', 'todayBookings'));
    }
}
