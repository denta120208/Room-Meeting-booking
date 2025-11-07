<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Block;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Check if a room is available for booking
     */
    public function isRoomAvailable($roomId, $startTime, $endTime, $excludeBookingId = null)
    {
        // Check if room exists and is active
        $room = Room::active()->find($roomId);
        if (!$room) {
            return false;
        }

        // Convert to Carbon instances if needed
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        // Check for conflicting bookings
        $conflictingBookings = Booking::conflictsWith($roomId, $startTime, $endTime, $excludeBookingId)->exists();
        if ($conflictingBookings) {
            return false;
        }

        // Check for conflicting blocks
        $conflictingBlocks = Block::conflictsWith($roomId, $startTime, $endTime)->exists();
        if ($conflictingBlocks) {
            return false;
        }

        return true;
    }

    /**
     * Create a new booking
     */
    public function createBooking($userId, $roomId, $title, $description, $startTime, $endTime)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        // Validate booking time
        if ($startTime >= $endTime) {
            throw new \InvalidArgumentException('Start time must be before end time');
        }

        if ($startTime < Carbon::now()) {
            throw new \InvalidArgumentException('Cannot book in the past');
        }

        // Check availability
        if (!$this->isRoomAvailable($roomId, $startTime, $endTime)) {
            throw new \InvalidArgumentException('Room is not available for the selected time');
        }

        return DB::transaction(function () use ($userId, $roomId, $title, $description, $startTime, $endTime) {
            return Booking::create([
                'user_id' => $userId,
                'room_id' => $roomId,
                'title' => $title,
                'description' => $description,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => 'confirmed',
            ]);
        });
    }

    /**
     * Cancel a booking
     */
    public function cancelBooking($bookingId, $userId = null)
    {
        $booking = Booking::find($bookingId);
        
        if (!$booking) {
            throw new \InvalidArgumentException('Booking not found');
        }

        // Check if user owns the booking (unless admin)
        if ($userId && $booking->user_id !== $userId) {
            $user = \App\Models\User::find($userId);
            if (!$user || !$user->isAdmin()) {
                throw new \InvalidArgumentException('Unauthorized to cancel this booking');
            }
        }

        $booking->update(['status' => 'cancelled']);
        return $booking;
    }

    /**
     * Get available time slots for a room on a specific date
     */
    public function getAvailableSlots($roomId, $date, $slotDuration = 60)
    {
        $date = Carbon::parse($date)->startOfDay();
        $startTime = $date->copy()->setTime(8, 0); // Start at 8 AM
        $endTime = $date->copy()->setTime(18, 0);  // End at 6 PM

        $availableSlots = [];
        $currentTime = $startTime->copy();

        while ($currentTime->copy()->addMinutes($slotDuration)->lte($endTime)) {
            $slotStart = $currentTime->copy();
            $slotEnd = $currentTime->copy()->addMinutes($slotDuration);

            if ($this->isRoomAvailable($roomId, $slotStart, $slotEnd)) {
                $availableSlots[] = [
                    'start' => $slotStart->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                    'start_datetime' => $slotStart,
                    'end_datetime' => $slotEnd,
                ];
            }

            $currentTime->addMinutes($slotDuration);
        }

        return $availableSlots;
    }

    /**
     * Create a block for a room
     */
    public function createBlock($adminId, $roomId, $reason, $startTime, $endTime)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        // Validate block time
        if ($startTime >= $endTime) {
            throw new \InvalidArgumentException('Start time must be before end time');
        }

        return DB::transaction(function () use ($adminId, $roomId, $reason, $startTime, $endTime) {
            // Cancel any existing bookings that conflict
            $conflictingBookings = Booking::conflictsWith($roomId, $startTime, $endTime)->get();
            foreach ($conflictingBookings as $booking) {
                $booking->update(['status' => 'cancelled']);
            }

            // Create the block
            return Block::create([
                'room_id' => $roomId,
                'admin_id' => $adminId,
                'reason' => $reason,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);
        });
    }

    /**
     * Get room statistics
     */
    public function getRoomStatistics($roomId, $startDate = null, $endDate = null)
    {
        $startDate = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $endDate = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $totalBookings = Booking::where('room_id', $roomId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->count();

        $confirmedBookings = Booking::where('room_id', $roomId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->count();

        $cancelledBookings = Booking::where('room_id', $roomId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->where('status', 'cancelled')
            ->count();

        $totalBlocks = Block::where('room_id', $roomId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->count();

        return [
            'total_bookings' => $totalBookings,
            'confirmed_bookings' => $confirmedBookings,
            'cancelled_bookings' => $cancelledBookings,
            'total_blocks' => $totalBlocks,
            'utilization_rate' => $totalBookings > 0 ? round(($confirmedBookings / $totalBookings) * 100, 2) : 0,
        ];
    }
}