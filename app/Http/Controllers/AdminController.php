<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Block;
use App\Models\Room;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalRooms = Room::count();
        $activeRooms = Room::active()->count();
        $totalBookings = Booking::count();
        $todayBookings = Booking::whereDate('start_time', Carbon::today())->count();
        $upcomingBookings = Booking::upcoming()->confirmed()->count();
        $totalUsers = User::where('role', 'user')->count();

        $recentBookings = Booking::with(['user', 'room'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $roomStats = Room::withCount(['bookings', 'blocks'])->get();

        return view('admin.dashboard', compact(
            'totalRooms', 'activeRooms', 'totalBookings', 'todayBookings',
            'upcomingBookings', 'totalUsers', 'recentBookings', 'roomStats'
        ));
    }

    /**
     * Display all bookings
     */
    public function bookings(Request $request)
    {
        $query = Booking::with(['user', 'room']);

        // Apply filters
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }

        $bookings = $query->orderBy('start_time', 'desc')->paginate(15);
        $rooms = Room::all();

        return view('admin.bookings', compact('bookings', 'rooms'));
    }

    /**
     * Show form to create a block
     */
    public function createBlock()
    {
        $rooms = Room::active()->get();
        return view('admin.blocks.create', compact('rooms'));
    }

    /**
     * Store a new block
     */
    public function storeBlock(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reason' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $this->bookingService->createBlock(
                Auth::id(),
                $request->room_id,
                $request->reason,
                $request->start_time,
                $request->end_time
            );

            return redirect()->route('admin.blocks')
                ->with('success', 'Block created successfully! Conflicting bookings have been cancelled.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display all blocks
     */
    public function blocks()
    {
        $blocks = Block::with(['room', 'admin'])
            ->orderBy('start_time', 'desc')
            ->paginate(15);

        return view('admin.blocks.index', compact('blocks'));
    }

    /**
     * Remove a block
     */
    public function destroyBlock(Block $block)
    {
        $block->delete();
        return back()->with('success', 'Block removed successfully!');
    }

    /**
     * Cancel any booking (admin privilege)
     */
    public function cancelBooking(Booking $booking)
    {
        try {
            $this->bookingService->cancelBooking($booking->id);
            return back()->with('success', 'Booking cancelled successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display room statistics
     */
    public function roomStatistics(Request $request)
    {
        $rooms = Room::all();
        $selectedRoom = $request->room_id ? Room::find($request->room_id) : $rooms->first();
        
        $statistics = [];
        if ($selectedRoom) {
            $statistics = $this->bookingService->getRoomStatistics(
                $selectedRoom->id,
                $request->start_date,
                $request->end_date
            );
        }

        return view('admin.statistics', compact('rooms', 'selectedRoom', 'statistics'));
    }
}
