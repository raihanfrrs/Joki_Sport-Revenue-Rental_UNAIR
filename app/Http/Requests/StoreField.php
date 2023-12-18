<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreField extends FormRequest
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
            'name' => 'required',
            'gor_id' => 'required',
            'field_category_id' => 'required',
            'description' => 'required',
            'field_image' => 'required|file|image'
        ];
    }
}
