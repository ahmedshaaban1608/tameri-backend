<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'tourist_id' => 'required|numeric',
            'tourguide_id' => 'required|numeric',
            'comment' => 'required|string',
            // 'phone' => 'required',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
            'from' => 'required|date',
            'to' => 'required|date',
            'total' => 'required|numeric',
            'city' => 'required|string',
        ];
    }
}
