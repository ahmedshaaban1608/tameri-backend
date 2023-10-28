<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "name"=> $this->name,
            "gender"=> $this->gender,
            "birth_date"=> $this->birth_date,
            "bio"=> $this->bio,
            "description"=> $this->description,
            "avatar"=>$this->avatar ? $this->avatar : null,
            "profile_img"=>$this->profile_img ? $this->profile_img : null,
            "day_price"=>$this->day_price ? $this->day_price : 0,
            "phone"=>$this->phone,
            "areas"=> AreaResource::collection($this->areas),
            "language"=> LanguageResource::collection($this->languages),
            "reviews"=> ReviewResource::collection($this->reviews),
        ];
    }
}
