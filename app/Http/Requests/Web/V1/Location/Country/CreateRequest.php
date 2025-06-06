<?php

namespace App\Http\Requests\Web\V1\Location\Country;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|string',
        ];
    }

    /**
     * Define custom validation messages for the email and password fields.
     *
     * @return array The custom error messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name field is required.',
            'name.string' => 'Please provide a valid string.',
        ];
    }
}
