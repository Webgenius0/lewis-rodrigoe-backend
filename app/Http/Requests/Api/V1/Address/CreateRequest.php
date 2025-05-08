<?php

namespace App\Http\Requests\Api\V1\Address;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
           'label'      => 'required|string',
           'street'     => 'required|string',
           'apartment'  => 'required|string',
           'country_id' => 'required|exists:countries,id',
           'state_id'   => 'required|exists:country_states,id',
           'city_id'    => 'required|exists:state_cities,id',
           'zip_id'     => 'required|exists:zip_id,id',
           'latitude'   => 'nullable',
           'longitude'  => 'nullable',
        ];
    }

    /**
     * failedValidation
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     * @return never
     */
    protected function failedValidation(Validator $validator): never
    {
        $fieldsToCheck = [
            'label',
            'street',
            'apartment',
            'country_id',
            'state_id',
            'city_id',
            'zip_id',
            'latitude',
            'longitude',
        ];
        $message = 'Validation error';

        foreach ($fieldsToCheck as $field) {
            $errors = $validator->errors()->get($field);
            if (!empty($errors)) {
                $message = $errors[0];
                break;
            }
        }

        $response = $this->error(
            422,
            $message,
            $validator->errors(),
        );

        throw new ValidationException($validator, $response);
    }
}
