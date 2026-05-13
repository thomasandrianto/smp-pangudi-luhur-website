<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'gender',
        'class_room_id',
        'photo',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}