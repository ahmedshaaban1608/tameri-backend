<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "avatar"=>$this->avatar ? $this->avatar : null,
            "profile_img"=>$this->profile_img ? $this->profile_img : null,
            "day_price"=>$this->day_price ? $this->day_price : 0,
            "phone"=>$this->phone,
            "languages"=> LanguageResource::collection($this->languages),
            "reviews" => $this->getAvgStars($reviews)
           

        ];
    }
}
