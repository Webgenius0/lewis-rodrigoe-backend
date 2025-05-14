<?php

namespace App\Http\Requests\Api\V1\Property\Job;

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
            'property_id'          => 'required|exists:properties,id',
            'engineer'             => 'required|exists:users,id',
            'title'                => 'required|string',
            'description'          => 'required|string',
            'date_time'            => 'required|date',
            'error_code'           => 'nullable|string',
            'error_code_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'water_pressure_level' => 'nullable|string',
            'tools_info'           => 'nullable|string',
            'additional_info'      => 'nullable|string',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'video'                => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',
            'engineer_assigned_at' => 'nullable|date',
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
            'property_id',
            'engineer',
            'title',
            'description',
            'date_time',
            'error_code',
            'error_code_image',
            'water_pressure_level',
            'tools_info',
            'additional_info',
            'image',
            'video',
            'engineer_assigned_at',
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
