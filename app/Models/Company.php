<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'roles',
        'name',
        'description',
        'images',
        'videos'
    ];

    /**
     * علاقة مع المستخدم (user) من خلال user_id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * إعداد الحقول images و videos للتعامل معها كـ JSON
     */
    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
    ];
}
