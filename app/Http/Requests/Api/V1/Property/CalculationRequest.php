<?php

namespace App\Http\Requests\Api\V1\Property;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CalculationRequest extends FormRequest
{
    use ApiResponse;
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
            'zip_id'             => 'required|exists:city_zips,id',
            'boiler_type_id'     => 'required|exists:boiler_types,id',
            'property_type_id'   => 'required|exists:property_types,id',
            'last_service_date'  => 'nullable|date|before_or_equal:today',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $fieldsToCheck =[
            'zip_id',
            'boiler_type_id',
            'property_type_id',
            'last_service_date',
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
