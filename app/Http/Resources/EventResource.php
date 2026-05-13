<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'description' => $this->description,

            // DATE BOX
            'day' => $this->start_date
                ? Carbon::parse($this->start_date)->format('d')
                : null,

            'month' => $this->start_date
                ? Carbon::parse($this->start_date)->format('M')
                : null,

            'year' => $this->start_date
                ? Carbon::parse($this->start_date)->format('Y')
                : null,

            // EXISTING
            'start_date' => $this->start_date
                ? Carbon::parse($this->start_date)->format('d M Y')
                : null,

            'end_date' => $this->end_date
                ? Carbon::parse($this->end_date)->format('d M Y')
                : null,

            'date_range' => $this->start_date
                ? (
                    $this->end_date && $this->end_date !== $this->start_date
                        ? Carbon::parse($this->start_date)->format('d M') . ' - ' .
                          Carbon::parse($this->end_date)->format('d M Y')
                        : Carbon::parse($this->start_date)->format('d M Y')
                )
                : null,

            'location' => $this->location,

            'time' => $this->time_text,
        ];
    }
}