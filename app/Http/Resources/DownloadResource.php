<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DownloadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'description' => $this->description,

            'file_url' => asset('storage/' . $this->file_path),

            'file_size' => $this->file_size,

            'download_count' => $this->download_count,

            'uploaded_by' => $this->uploaded_by,

            'created_at' => $this->created_at
                ? $this->created_at->format('d M Y')
                : null,
        ];
    }
}