<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'name',
        'email',
        'content',
        'parent_id',
        'is_approved',
    ];

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Parent comment (reply)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Child comments (balasan)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->where('is_approved', true)
            ->latest();
    }
}