<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TouristDataResource extends JsonResource
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
            "avatar"=> $this->avatar ? $this->avatar : null,
            "phone"=> $this->phone,
            "reviews"=> ReviewResource::collection($this->reviews),
            "orders"=> OrderResource::collection($this->orders),

        ];
    }
}
