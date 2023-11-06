<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TouristResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->user->name,
            "type"=> $this->user->type,
            "email"=> $this->user->email,
            "country"=> $this->country,
            "gender"=> $this->gender,
            'avatar' => isset($this->avatar) ? (Str::startsWith($this->avatar, 'http') ? $this->avatar : env('APP_URL').':8000/img/'.$this->avatar) : '/assets/user-avatar.png',
            "phone"=> $this->phone,
        ];
    }
}
