<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Rules\Api\V1\Auth\Validatepassword;
use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
            "email"    => "required|email|exists:users,email",
            "password" => ["required", new Validatepassword($this->input('email'))]
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
            'email.required' => 'Email field is required.',
            'email.email'    => 'Please provide a valid email address.',
            'email.exists'   => 'This email address is not registered in our system.',
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
        $fieldsToCheck = ['email', 'password'];
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
