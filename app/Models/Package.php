<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'deadline' => 'datetime'
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class, 'package_event');
    }
}
