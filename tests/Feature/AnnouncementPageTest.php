<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AnnouncementPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_announcement_index_returns_data(): void
    {
        Announcement::factory()->count(3)->create([
            'published_at' => now(),
        ]);

        $response = $this->get('/pengumuman');

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Announcements/Index')
                ->has('announcements.data', 3)
                ->has('announcements.links')
        );
    }

    public function test_announcement_show_returns_detail(): void
    {
        $announcement = Announcement::factory()->create([
            'published_at' => now(),
        ]);

        Announcement::factory()->count(5)->create([
            'published_at' => now(),
        ]);

        $response = $this->get('/pengumuman/' . $announcement->id);

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Announcements/Show')
                ->where('announcement.id', $announcement->id)
                ->has('latestAnnouncements')
        );
    }
}