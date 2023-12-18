<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGor extends FormRequest
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
        $gorId = $this->route('gor');

        return [
            'name' => [
                'required',
                Rule::unique('gors', 'name')->ignore($gorId)
            ],
            'price' => 'required|numeric',
            'type_duration' => 'required',
            'address' => 'required',
            'gor_image' => 'required|file|image'
        ];
    }
}