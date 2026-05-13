<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

use Inertia\Inertia;

use Illuminate\Support\Facades\Cache;

use App\Http\Resources\PostResource;
use App\Http\Resources\CommentResource;

class PostController extends Controller
{
    /**
     * BLOG INDEX
     */
    public function index()
    {
        // POSTS
        $posts = PostResource::collection(
            Post::with(['category', 'author'])
                ->where('is_published', 1)
                ->latest('published_at')
                ->paginate(6)
        );

        return Inertia::render('Blog/Index', [
            'posts' => $posts,

            'popularPosts' => $this->popularPosts(),

            'categories' => $this->categories(),
        ]);
    }

    /**
     * DETAIL BLOG
     */
    public function show($slug)
    {
        // POST
        $post = Post::with([
                'category',
                'author',
                'comments',
            ])
            ->where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        // INCREMENT VIEWS
        $post->increment('views');

        // COMMENTS
        $comments = CommentResource::collection(
            Comment::with('replies')
                ->where('post_id', $post->id)
                ->whereNull('parent_id')
                ->where('is_approved', true)
                ->latest()
                ->get()
        )->resolve();

        return Inertia::render('Blog/Show', [
            'post' => (new PostResource($post))->resolve(),

            'comments' => $comments,

            'popularPosts' => $this->popularPosts($post->id),

            'categories' => $this->categories(),
        ]);
    }

    /**
     * POSTS BY CATEGORY
     */
    public function category($slug)
    {
        // CATEGORY
        $category = Category::where('slug', $slug)->firstOrFail();

        // POSTS
        $posts = PostResource::collection(
            Post::with(['category', 'author'])
                ->where('is_published', 1)
                ->where('category_id', $category->id)
                ->latest('published_at')
                ->paginate(6)
        );

        return Inertia::render('Blog/Index', [
            'posts' => $posts,

            'popularPosts' => $this->popularPosts(),

            'categories' => $this->categories(),

            'currentCategory' => $category,
        ]);
    }

    /**
     * POPULAR POSTS
     */
    private function popularPosts($exceptId = null)
    {
        $cacheKey = $exceptId
            ? "blog_popular_posts_except_{$exceptId}"
            : "blog_popular_posts";

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(30),
            function () use ($exceptId) {

                $query = Post::with(['category'])
                    ->where('is_published', 1);

                if ($exceptId) {
                    $query->where('id', '!=', $exceptId);
                }

                return PostResource::collection(
                    $query->orderByDesc('views')
                        ->take(5)
                        ->get()
                )->resolve();
            }
        );
    }

    /**
     * CATEGORIES
     */
    private function categories()
    {
        return Cache::remember(
            'blog_categories',
            now()->addHours(1),
            function () {
                return Category::withCount([
                        'posts' => function ($query) {
                            $query->where('is_published', 1);
                        }
                    ])
                    ->orderBy('name')
                    ->get();
            }
        );
    }
}