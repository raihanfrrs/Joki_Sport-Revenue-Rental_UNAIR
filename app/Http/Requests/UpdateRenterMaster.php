<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRenterMaster extends FormRequest
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
        $renterId = $this->route('renter');

        return [
            'name' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique((new User)->getTable())->ignore($renterId->user),
            ],
            'phone' => [
                'required',
                'numeric',
                Rule::unique('renters')->ignore($renterId)
            ]
        ];
    }
}
