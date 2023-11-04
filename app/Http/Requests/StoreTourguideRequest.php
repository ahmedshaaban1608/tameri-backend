<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourguideRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z]{3,}(?:\s[a-zA-Z]{3,})*$/',
            'email' => 'required|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:6|max:15',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourguides|regex:/^\+?\d{7,14}$/',
            'bio' => 'required|min:10|max:50',
            'description' => 'required|min:100|max:1000',
            'day_price' => 'required|numeric',
        ];
    }
}
