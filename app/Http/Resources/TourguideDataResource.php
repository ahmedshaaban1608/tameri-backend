<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TourguideDataResource extends JsonResource
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
            "gender"=> $this->gender,
            "birth_date"=> $this->birth_date,
            "bio"=> $this->bio,
            "description"=> $this->description,
            'avatar' => isset($this->avatar) ? (Str::startsWith($this->avatar, 'http') ? $this->avatar : env('APP_URL').':8000/img/'.$this->avatar) : '/assets/tourguide-avatar.png',
            "profile_img"=>isset($this->profile_img) ? (Str::startsWith($this->profile_img, 'http') ? $this->profile_img : env('APP_URL').':8000/img/'.$this->profile_img) : '/assets/profile_img.jpg',
            "day_price"=>$this->day_price ? $this->day_price : 0,
            "phone"=>$this->phone,
            "areas"=> AreaResource::collection($this->areas),
            "languages"=> LanguageResource::collection($this->languages),
            'reviews' => ReviewResource::collection($this->reviews()->where('status', 'confirmed')->latest()->get()),
            "orders"=> OrderResource::collection($this->orders()->latest()->get()),
        ];
    }
}
