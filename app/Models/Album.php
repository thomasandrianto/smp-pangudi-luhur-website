<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'created_by',
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}