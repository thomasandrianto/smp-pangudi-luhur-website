<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Inertia\Inertia;

use App\Http\Resources\EventResource;

class EventController extends Controller
{
    // INDEX
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')
            ->paginate(10);

        return Inertia::render('Events/Index', [
            'events' => [
                'data' => EventResource::collection($events)->resolve(),

                'links' => $events->linkCollection(),
            ],
        ]);
    }

    // DETAIL
    public function show($id)
    {
        $event = Event::findOrFail($id);

        $latestEvents = Event::where('id', '!=', $id)
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        return Inertia::render('Events/Show', [

            'event' => (new EventResource($event))->resolve(),

            'latestEvents' => EventResource::collection(
                $latestEvents
            )->resolve(),
        ]);
    }
}