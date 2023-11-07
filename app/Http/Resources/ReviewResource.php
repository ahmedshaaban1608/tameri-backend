<?php

namespace App\Http\Resources;

use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tourist_avatar = Tourist::withTrashed()->find($this->tourist_id)->avatar;
        return [
            "id"=> $this->id,
            "tourist_id"=> $this->tourist_id,
            "tourist_name" => User::withTrashed()->find($this->tourist_id)->name,
            "tourist_avatar" => isset($tourist_avatar) ? (Str::startsWith($tourist_avatar, 'http') ? $tourist_avatar : env('APP_URL').':8000/img/'.$tourist_avatar) : '/assets/user-avatar.png',
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
