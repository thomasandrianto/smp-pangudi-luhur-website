<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Inertia\Inertia;

use App\Http\Resources\AnnouncementResource;

class AnnouncementController extends Controller
{
    // INDEX
    public function index()
    {
        $announcements = Announcement::latest('published_at')
            ->paginate(10);

        return Inertia::render('Announcements/Index', [
            'announcements' => [
                'data' => AnnouncementResource::collection(
                    $announcements
                )->resolve(),

                'links' => $announcements->linkCollection(),
            ],
        ]);
    }

    // DETAIL
    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);

        $latestAnnouncements = Announcement::where('id', '!=', $id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return Inertia::render('Announcements/Show', [

            // FIX
            'announcement' => (new AnnouncementResource(
                $announcement
            ))->resolve(),

            // FIX
            'latestAnnouncements' => AnnouncementResource::collection(
                $latestAnnouncements
            )->resolve(),
        ]);
    }
}