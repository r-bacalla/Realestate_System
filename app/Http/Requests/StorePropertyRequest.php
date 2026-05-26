<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'area_sqm' => ['required', 'integer', 'min:0'],
            'year_built' => ['nullable', 'integer', 'digits:4'],
            'type' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:available,rented,sold,maintenance'],
            'image_path' => ['nullable', 'url', 'max:2048'],
        ];
    }
}
