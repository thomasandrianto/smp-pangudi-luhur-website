<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Inertia\Inertia;
use App\Http\Resources\TeacherResource;

class TeacherController extends Controller
{
    public function index()
    {
        return Inertia::render('Teachers/Index', [
            'teachers' => TeacherResource::collection(
                Teacher::orderBy('name')->get()
            )
        ]);
    }
}
