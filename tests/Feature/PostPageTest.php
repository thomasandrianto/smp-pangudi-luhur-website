<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PostPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_returns_posts(): void
    {
        Cache::flush();

        $category = Category::factory()->create();
        $author = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        Post::factory()->count(3)->create([
            'category_id' => $category->id,
            'author_id' => $author->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Blog/Index')
                ->has('posts.data', 3)
                ->has('popularPosts')
                ->has('categories')
        );
    }

    public function test_blog_show_returns_post_detail(): void
    {
        Cache::flush();

        $category = Category::factory()->create();
        $author = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $post = Post::factory()->create([
            'category_id' => $category->id,
            'author_id' => $author->id,
            'is_published' => true,
            'published_at' => now(),
            'views' => 0,
        ]);

        $response = $this->get('/blog/' . $post->slug);

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Blog/Show')
                ->where('post.slug', $post->slug)
                ->has('comments')
                ->has('popularPosts')
                ->has('categories')
        );
    }

    public function test_blog_show_increments_views(): void
    {
        Cache::flush();

        $category = Category::factory()->create();
        $author = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $post = Post::factory()->create([
            'category_id' => $category->id,
            'author_id' => $author->id,
            'is_published' => true,
            'published_at' => now(),
            'views' => 0,
        ]);

        $this->get('/blog/' . $post->slug);

        $post->refresh();

        $this->assertEquals(1, $post->views);
    }

    public function test_blog_category_filter_returns_only_selected_category_posts(): void
    {
        Cache::flush();

        $category1 = Category::factory()->create([
            'slug' => 'berita',
        ]);

        $category2 = Category::factory()->create([
            'slug' => 'prestasi',
        ]);

        $author = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        Post::factory()->count(2)->create([
            'category_id' => $category1->id,
            'author_id' => $author->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        Post::factory()->count(3)->create([
            'category_id' => $category2->id,
            'author_id' => $author->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/blog/category/berita');

        $response->assertStatus(200);

        $response->assertInertia(fn (Assert $page) =>
            $page
                ->component('Blog/Index')
                ->has('posts.data', 2)
                ->where('currentCategory.slug', 'berita')
        );
    }
}