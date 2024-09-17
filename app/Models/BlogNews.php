<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogNews extends Model
{
    use HasFactory;

    protected $table = 'blog_news';

    protected $fillable = [
        'title',
        'content',
        'images',
        'videos',
        'author_id',
    ];

    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
    ];

    /**
     * Get the author of the blog/news post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
