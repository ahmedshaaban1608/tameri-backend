<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            "tourist_id"=> $this->tourist_id,
            "tourguide_id"=> $this->tourguide_id,
            "title"=> $this->title,
            "comment"=> $this->comment,
            "stars"=> $this->stars,
            "status"=> $this->status,
            "date"=>$this->created_at
        ];
    }
}
