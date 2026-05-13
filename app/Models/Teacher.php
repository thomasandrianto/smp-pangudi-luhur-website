<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'gender',
        'subject',
        'place_of_birth',
        'date_of_birth',
        'photo',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}