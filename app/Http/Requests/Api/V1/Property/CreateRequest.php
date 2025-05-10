<?php

namespace App\Http\Requests\Api\V1\Property;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateRequest extends FormRequest
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
            'label' => 'required|string',
            'street' => 'required|string',
            'apartment' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:country_states,id',
            'city_id' => 'required|exists:state_cities,id',
            'zip_id' => 'required|exists:city_zips,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'boiler_type_id' => 'required|exists:boiler_types,id',
            'boiler_model_id' => 'required|exists:boiler_models,id',
            'property_type_id' => 'required|exists:property_types,id',
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer',
            'purchase_year' => 'required|date',
            'last_service_date' => 'nullable|date',
            'location' => 'required|string',
            'accessability_info' => 'required|string',
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
        $fieldsToCheck =[
            'label',
            'street',
            'apartment',
            'country_id',
            'state_id',
            'city_id',
            'zip_id',
            'latitude',
            'longitude',
            'boiler_type_id',
            'boiler_model_id',
            'property_type_id',
            'service_id',
            'quantity',
            'purchase_year',
            'last_service_date',
            'location',
            'accessability_info',
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
