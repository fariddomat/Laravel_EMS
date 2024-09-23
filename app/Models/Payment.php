<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'amount',
        'status',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event associated with the payment.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

     // Notify user when payment is made
     public static function boot()
     {
         parent::boot();

         static::created(function ($payment) {
            try {
                Notification::create([
                    'user_id' => $payment->user_id,
                    'message' => 'Your payment of ' . $payment->amount . ' has been received.',
                    'type' => 'auto',
                    'status' => 'unread',
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
         });
     }
}
