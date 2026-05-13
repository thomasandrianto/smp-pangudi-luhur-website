<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        return Inertia::render('Page/Show', [
            'page' => $page
        ]);
    }
}