<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTouristRequest extends FormRequest
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
            'id' => 'required|unique:tourists|numeric',
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ];
    }
}
