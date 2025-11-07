<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'admin_id',
        'reason',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the room that is blocked
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the admin who created the block
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope for active blocks
     */
    public function scopeActive($query)
    {
        return $query->where('end_time', '>', Carbon::now());
    }

    /**
     * Check if block conflicts with given time range
     */
    public function scopeConflictsWith($query, $roomId, $startTime, $endTime, $excludeBlockId = null)
    {
        $query = $query->where('room_id', $roomId)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function ($inner) use ($startTime, $endTime) {
                      $inner->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                  });
            });

        if ($excludeBlockId) {
            $query->where('id', '!=', $excludeBlockId);
        }

        return $query;
    }
}