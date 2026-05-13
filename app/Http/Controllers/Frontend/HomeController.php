<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use Inertia\Inertia;

// IMPORT RESOURCE
use App\Http\Resources\PostResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\AnnouncementResource;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialResource;

class HomeController extends Controller
{
    public function index()
    {
        // PENGUMUMAN
        $announcements = AnnouncementResource::collection(
            Announcement::latest('published_at')
                ->take(5)
                ->get()
        );

        // AGENDA
        $events = EventResource::collection(
            Event::orderBy('start_date')
                ->take(5)
                ->get()
        );

        // BERITA
        $posts = PostResource::collection(
            Post::with(['category', 'author'])
                ->where('is_published', 1)
                ->latest('published_at')
                ->take(6)
                ->get()
        );

        // TESTIMONI
        $testimonials = TestimonialResource::collection(
            Testimonial::where('is_published', true)
                ->latest()
                ->take(6)
                ->get()
        );

        return Inertia::render('Home', [
            'announcements' => $announcements->resolve(),

            'events' => $events->resolve(),

            'posts' => $posts->resolve(),

            'testimonials' => $testimonials->resolve(),
        ]);
    }
}