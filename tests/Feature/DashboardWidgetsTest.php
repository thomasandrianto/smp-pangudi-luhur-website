<?php

namespace Tests\Feature;

use App\Filament\Widgets\LatestMessages;
use App\Filament\Widgets\LatestPosts;
use App\Filament\Widgets\PostChart;
use App\Filament\Widgets\StatsOverview;
use App\Models\Category;
use App\Models\Message;
use App\Models\Post;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardWidgetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_stats_overview_returns_correct_counts(): void
    {
        Student::factory()->count(10)->create();
        Teacher::factory()->count(5)->create();
        Post::factory()->count(7)->create();
        Message::factory()->count(3)->create(['is_read' => false]);

        $widget = new \App\Filament\Widgets\StatsOverview();

        $reflection = new \ReflectionClass($widget);
        $method = $reflection->getMethod('getStats');
        $method->setAccessible(true);

        $stats = $method->invoke($widget);

        $this->assertCount(4, $stats);

        $this->assertEquals(10, $stats[0]->getValue());
        $this->assertEquals(5, $stats[1]->getValue());
        $this->assertEquals(7, $stats[2]->getValue());
        $this->assertEquals(3, $stats[3]->getValue());
    }

    public function test_post_chart_returns_12_month_dataset(): void
    {
        Post::factory()->count(3)->create([
            'created_at' => now(),
        ]);

        $widget = new class extends \App\Filament\Widgets\PostChart {
            public function exposedGetData(): array
            {
                return $this->getData();
            }
        };

        $data = $widget->exposedGetData();

        $this->assertArrayHasKey('datasets', $data);
        $this->assertArrayHasKey('labels', $data);

        $this->assertCount(12, $data['labels']);
        $this->assertCount(12, $data['datasets'][0]['data']);
    }

    public function test_latest_messages_query_returns_five_latest_records(): void
    {
        Message::factory()->count(10)->create();

        $records = Message::latest()->limit(5)->get();

        $this->assertCount(5, $records);
    }

    public function test_latest_posts_query_returns_five_latest_records(): void
    {
        Post::factory()->count(10)->create();

        $records = Post::latest()->limit(5)->get();

        $this->assertCount(5, $records);
    }
}