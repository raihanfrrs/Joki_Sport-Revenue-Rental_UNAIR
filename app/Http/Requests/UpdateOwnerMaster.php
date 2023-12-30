<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerMaster extends FormRequest
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
        $ownerId = $this->route('owner');

        return [
            'name' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique((new User)->getTable())->ignore($ownerId->user),
            ],
            'phone' => [
                'required',
                Rule::unique('owners')->ignore($ownerId)
            ]
        ];
    }
}
