<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Inertia\Inertia;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        return Inertia::render('Students/Index', [
            'students' => StudentResource::collection(
                Student::with('classRoom')
                    ->orderBy('name')
                    ->get()
            )
        ]);
    }
}
