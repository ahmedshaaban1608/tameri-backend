<?php

namespace App\Http\Resources;

use App\Models\Tourguide;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tourguide_avatar = Tourguide::withTrashed()->find($this->tourguide_id)->avatar;
        $tourist_avatar = Tourist::withTrashed()->find($this->tourist_id)->avatar;

        return [
            "id"=> $this->id,
            "tourist_id"=> $this->tourist_id,
            "tourist_name" => User::withTrashed()->find($this->tourist_id)->name,
            "tourguide_id"=> $this->tourguide_id,
            "tourguide_name" => User::withTrashed()->find($this->tourguide_id)->name,
            "tourguide_phone" => Tourguide::withTrashed()->find($this->tourguide_id)->phone,
            "tourguide_avatar" => isset($tourguide_avatar) ? (Str::startsWith($tourguide_avatar, 'http') ? $tourguide_avatar : env('APP_URL').':8000/img/'.$tourguide_avatar) : '/assets/tourguide-avatar.png',
            "tourist_avatar" => isset($tourist_avatar) ? (Str::startsWith($tourist_avatar, 'http') ? $tourist_avatar : env('APP_URL').':8000/img/'.$tourist_avatar) : '/assets/user-avatar.png',
            "status"=> $this->status,
            "payment"=> $this->payment,
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
