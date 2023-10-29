<?php

namespace App\Http\Resources;

use App\Models\Tourist;
use App\Models\User;
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
            "tourist_name" => User::withTrashed()->find($this->tourist_id)->name,
            "tourist_avatar" => Tourist::withTrashed()->find($this->tourist_id)->avatar,
            "tourguide_id"=> $this->tourguide_id,
            "tourguide_name" => User::withTrashed()->find($this->tourguide_id)->name,
            "title"=> $this->title,
            "comment"=> $this->comment,
            "stars"=> $this->stars,
            "status"=> $this->status,
            "date"=>$this->created_at
        ];
    }
}
