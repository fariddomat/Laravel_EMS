<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
