<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'booking_date',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'status' => 'string',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Automatically notify user when status changes
     public function setStatusAttribute($value)
     {
         $this->attributes['status'] = $value;

         if ($this->isDirty('status')) {
             try {
                Notification::create([
                    'user_id' => $this->user_id,
                    'message' => 'Your booking status has been updated to ' . $value,
                    'type' => 'auto',
                    'status' => 'unread',
                ]);
             } catch (\Throwable $th) {
                //throw $th;
             }
         }
     }
}
