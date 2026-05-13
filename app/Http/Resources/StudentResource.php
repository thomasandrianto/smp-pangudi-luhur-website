<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,

            'nis' => $this->nis,

            'gender' => $this->gender === 'L' ? 'Laki-laki' : 'Perempuan',

            'class' => $this->classRoom?->name,

            'photo' => $this->photo
                ? asset('storage/' . $this->photo)
                : null,
        ];
    }
}