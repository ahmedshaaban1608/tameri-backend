<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tourist_id'=> 'required|numeric',
            'tourguide_id'=> 'required|numeric',
            'title' => 'required|string',
            'comment' => 'required|string',
            'stars' => 'required|in:1,2,3,4,5',

            //
        ];
    }
}
