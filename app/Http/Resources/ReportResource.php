<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            "user_id"=> $this->user_id,
            "user_name"=> User::withTrashed()->find($this->user_id)->name,
            "subject"=> $this->subject,
            "problem"=> $this->problem,
            "image"=> $this->image? $this->image : null,
            "date"=> $this->created_at
        ];
    }
}
