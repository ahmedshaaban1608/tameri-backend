<?php

namespace App\Http\Resources;

use App\Models\Tourguide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "tourguide_id"=> $this->tourguide_id,
            "tourguide_name" => User::withTrashed()->find($this->tourguide_id)->name,
            "tourguide_avatar" => Tourguide::withTrashed()->find($this->tourguide_id)->avatar,
            "status"=> $this->status,
            "comment"=> $this->comment,
            "phone"=> $this->phone,
            "startDate"=> $this->from,
            "endDate"=> $this->to,
            "totalPrice"=> $this->total,
            "city"=> $this->city,
            "date"=> $this->created_at,
        ];
    }
}
