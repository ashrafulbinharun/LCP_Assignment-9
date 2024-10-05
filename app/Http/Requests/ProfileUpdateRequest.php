<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string'],
            'username' => [
                'sometimes', 'required', 'string', 'max:30',
                Rule::unique('users', 'username')->ignore($this->user()->id),
            ],
            'password' => ['sometimes', 'nullable', 'confirmed', Password::min(6)],
            'bio' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation()
    {
        if (! $this->filled('password')) {
            // Removes the password field if not provided
            $this->request->remove('password');
        }
    }
}
