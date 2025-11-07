<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of user's bookings
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('room')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create(Request $request)
    {
        $rooms = Room::active()->get();
        $selectedRoom = $request->room_id ? Room::find($request->room_id) : null;
        $selectedDate = $request->date ? Carbon::parse($request->date) : Carbon::today();

        $availableSlots = [];
        if ($selectedRoom) {
            $availableSlots = $this->bookingService->getAvailableSlots(
                $selectedRoom->id, 
                $selectedDate
            );
        }

        return view('bookings.create', compact('rooms', 'selectedRoom', 'selectedDate', 'availableSlots'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $booking = $this->bookingService->createBooking(
                Auth::id(),
                $request->room_id,
                $request->title,
                $request->description,
                $request->start_time,
                $request->end_time
            );

            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Booking created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified booking
     */
    public function show(Booking $booking)
    {
        // Check if user owns the booking or is admin
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $booking->load('room', 'user');
        return view('bookings.show', compact('booking'));
    }

    /**
     * Cancel the specified booking
     */
    public function cancel(Booking $booking)
    {
        try {
            $this->bookingService->cancelBooking($booking->id, Auth::id());
            return back()->with('success', 'Booking cancelled successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Get available slots for a room on a specific date (AJAX)
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date',
        ]);

        $slots = $this->bookingService->getAvailableSlots(
            $request->room_id,
            $request->date
        );

        return response()->json($slots);
    }
}
