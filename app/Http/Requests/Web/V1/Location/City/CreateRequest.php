<?php

namespace App\Http\Requests\Web\V1\Location\City;

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
            'state_id' => 'required|string|exists:country_states,id',
        ];
    }

    /**
     * messages
     * @return array{country_id.required: string, country_id.string: string, name.required: string, name.string: string}
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',

            'state_id.required' => 'Please select a state.',
            'state_id.string' => 'Invalid state format.',
            'state_id.exists' => 'The selected state does not exist.',
        ];
    }
}
