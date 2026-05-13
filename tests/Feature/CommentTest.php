<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_submit_comment(): void
    {
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'category_id' => $category->id,
            'title' => 'Test Post',
            'slug' => 'test-post',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->post("/blog/{$post->slug}/comment", [
            'name' => 'Thomas',
            'email' => 'admin@gmail.com',
            'content' => 'Artikel yang sangat bagus.',
        ]);

        $response
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'name' => 'Thomas',
            'email' => 'admin@gmail.com',
            'is_approved' => false,
        ]);
    }
}