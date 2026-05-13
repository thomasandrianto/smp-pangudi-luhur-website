<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'excerpt' => \Str::limit(strip_tags($this->content), 120),

            'content' => $this->content,

            // TAMBAHAN
            'day' => $this->published_at?->format('d'),

            'month' => $this->published_at?->format('M'),

            'year' => $this->published_at?->format('Y'),

            // OPTIONAL
            'date' => $this->published_at?->format('d M Y'),
        ];
    }
}