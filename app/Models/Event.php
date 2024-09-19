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
        'price'
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
}
