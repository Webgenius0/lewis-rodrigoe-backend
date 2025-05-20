<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class EmployRegistrationRequest extends FormRequest
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
            // 'avatar'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'email'      => "required|email|unique:users",
            'first_name' => "required|string",
            'last_name'  => "required|string",
            'password '  => "required|confirmed",
            'gender'     => 'required|in:male,femail,others',
            'phone'      => 'required|phone:GB',
            'role'       => 'required|in:4,5,6',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $fieldsToCheck = ['email', 'operation'];
        $message = 'Validation error'; // Default message

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
