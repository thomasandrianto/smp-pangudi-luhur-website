<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,

            // FIX THUMBNAIL
            'thumbnail' => $this->thumbnail
                ? asset('storage/' . $this->thumbnail)
                : null,

            // CATEGORY
            'category' => $this->category?->name,

            // AUTHOR
            'author' => $this->author?->name,

            //DATE FORMAT
            'date' => $this->published_at
                ? $this->published_at->format('d M Y')
                : null,

            // EXCERPT (INI YANG KEMARIN KOSONG)
            'excerpt' => Str::limit(strip_tags($this->content), 120),

            // FULL CONTENT (buat halaman detail)
            'content' => $this->content,

            'views' => $this->views,
        ];
    }
}