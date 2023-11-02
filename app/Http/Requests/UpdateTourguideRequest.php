<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateTourguideRequest extends FormRequest
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
            //
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'bio' => 'required|string',
            'description' => 'required|string',
            'profile_img' => 'required|string',
            'day_price' => 'required|numeric',
            'phone' => ['required','regex:/^\+?\d{7,14}$/',Rule::unique('tourguides')->ignore($tourguide)],
        ];
    }
}
