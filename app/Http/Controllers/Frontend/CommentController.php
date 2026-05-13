<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new blog comment.
     */
    public function store(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:100',
            ],
            'content' => [
                'required',
                'string',
                'min:3',
                'max:2000',
            ],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:comments,id',
            ],
        ]);

        $post = Post::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        Comment::create([
            'post_id' => $post->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'content' => trim($validated['content']),
            'is_approved' => false,
        ]);

        return back()->with(
            'success',
            'Komentar berhasil dikirim dan menunggu persetujuan admin.'
        );
    }
}