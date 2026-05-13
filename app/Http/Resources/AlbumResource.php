<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,

            'cover' => $this->cover
                ? asset('storage/' . $this->cover)
                : null,

            'total_photos' => $this->galleries_count ?? 0,

            'preview_images' => $this->whenLoaded('galleries', function () {
                return $this->galleries->take(5)->map(function ($item) {
                    return asset('storage/' . $item->image);
                });
            }),
        ];
    }
}