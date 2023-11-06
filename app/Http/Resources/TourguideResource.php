<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TourguideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


     public function getAvgStars($reviews){
        $stars = 0;
        $avg = 0;
        $count = 0;
        foreach ($reviews as $value) {
            if (isset($value['stars'])) {
                if($value['status'] === 'confirmed'){
                $stars += $value['stars'];
                $count++;             
                }
            }
        }
        $avg = $stars/($count ? $count : 1);
        return ['avg'=>$avg];
    }
    public function toArray(Request $request): array
    {
        $reviews = ReviewResource::collection($this->reviews);
        
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
            "languages"=> LanguageResource::collection($this->languages),
            "reviews" => $this->getAvgStars($reviews)
           

        ];
    }
}
