<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Traits\V1\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PlumberRegistrationRequest extends FormRequest
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
            'email'        => "required|email|unique:users",
            'first_name'   => "required|string",
            'last_name'    => "required|string",
            'password'     => "required|confirmed",
            'gender'       => 'required|in:male,female,others',
            'phone'        => 'required|phone:GB',
            'expertise_id' => 'required|exists:expertises,id',

            'ni'  => 'required|string|unique:engineers,ni',
            'utr' => 'required|string|unique:engineers,utr',

            'gas_number'      => 'required|string|unique:gas_safety_registrations,id',
            'gas_issue_date'  => 'required|date',
            'gas_expire_date' => 'required|date',
            'gas_card_front'  => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'gas_card_back'   => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',

            'street'     => 'required|string',
            'apartment'  => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'state_id'   => 'required|exists:country_states,id',
            'city_id'    => 'required|exists:state_cities,id',
            'zip_id'     => 'required|exists:city_zips,id',
            'latitude'   => 'nullable|numeric',
            'longitude'  => 'nullable|numeric',

            'bank_accounts_name'           => 'required|string',
            'bank_accounts_number'         => 'required|string',
            'bank_accounts_bank_name'      => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $fieldsToCheck = [
            'email',
            'first_name',
            'last_name',
            'password',
            'gender',
            'phone',
            'expertise_id',

            'ni',
            'utr',

            'gas_number',
            'gas_issue_date',
            'gas_expire_date',
            'gas_card_front',
            'gas_card_back',

            'street',
            'apartment',
            'country_id',
            'state_id',
            'city_id',
            'zip_id',
            'latitude',
            'longitude',

            'bank_accounts_name',
            'bank_accounts_number',
            'bank_accounts_bank_name',
        ];
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
