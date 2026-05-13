<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class EventPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_index_returns_data(): void
    {
        Event::factory()->count(4)->create([
            'start_date' => now(),
        ]);

        $response = $this->get('/agenda');

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Events/Index')
                ->has('events.data', 4)
                ->has('events.links')
        );
    }

    public function test_event_show_returns_detail(): void
    {
        $event = Event::factory()->create([
            'start_date' => now(),
        ]);

        Event::factory()->count(5)->create([
            'start_date' => now()->addDays(1),
        ]);

        $response = $this->get('/agenda/' . $event->id);

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Events/Show')
                ->where('event.id', $event->id)
                ->has('latestEvents')
        );
    }
}