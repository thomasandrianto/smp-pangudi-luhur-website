<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,

            'nip' => $this->nip,

            'gender' => $this->gender === 'L' ? 'Laki-laki' : 'Perempuan',

            'subject' => $this->subject,

            'birth_info' => $this->place_of_birth && $this->date_of_birth
                ? $this->place_of_birth . ', ' . $this->date_of_birth->format('d M Y')
                : null,

            'photo' => $this->photo
                ? asset('storage/' . $this->photo)
                : null,
        ];
    }
}