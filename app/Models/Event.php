<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    // The table associated with the model.
    protected $table = 'events';

    // The attributes that are mass assignable.
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'images',
        'videos',
        'price',
        'status'
    ];

    // Cast the images and videos attributes to arrays.
    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
    ];

    // Define the relationship with the Company model.
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function comments(){
        return $this->hasMany(CommentRating::class);
    }
    public function getIsFavoriteAttribute()
    {
        // Check if a user is authenticated
        if (Auth::check()) {
            return $this->favorites()->where('user_id', Auth::id())->exists();
        }
        return false;  // Not favorited if the user is not authenticated
    }
    public function favorites()
    {
        return $this->hasMany(favorite::class);
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_event');
    }

    public function user()
{
    return $this->hasOneThrough(User::class, Company::class, 'id', 'id', 'company_id', 'user_id');
}

    public function setStatusAttribute($value)
{
    // Only proceed if the status is being updated to 'confirmed'
    if ($this->status != $value) {
        
        try {
            Notification::create([
                'user_id' => $this->user->id, // The user who made the booking
                'message' => 'The event "' . $this->name . '" has been "'.$value.'".',
                'type' => 'auto',
                'status' => 'unread',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Finally, set the status attribute
    $this->attributes['status'] = $value;
}

}
