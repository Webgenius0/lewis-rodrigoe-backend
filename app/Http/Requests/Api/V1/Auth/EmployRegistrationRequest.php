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
            'email'        => "required|email|unique:users",
            'first_name'   => "required|string",
            'last_name'    => "required|string",
            'password'    => "required|confirmed",
            'gender'       => 'required|in:male,femail,others',
            'phone'        => 'required|phone:GB',
            'expertise_id' => 'required|exists:expertises,id',

            'ni'  => 'required|string',
            'utr' => 'required|boolean',

            'gas_number'      => 'required|string',
            'gas_issue_date'  => 'required|date',
            'gas_expire_date' => 'required|date',
            'gas_cart_front'  => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'gas_card_back'   => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',

            'nic_eic_number'      => 'required|string',
            'nic_eic_issue_date'  => 'required|date',
            'nic_eic_expire_date' => 'required|date',
            'nic_eic_cart_front'  => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'nic_eic_card_back'   => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',

            'driving_licence_number'      => 'required|string',
            'driving_licence_issue_date'  => 'required|date',
            'driving_licence_expire_date' => 'required|date',
            'driving_licence_cart_front'  => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            'driving_licence_card_back'   => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',

            'label'      => 'required|string',
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
            'bank_accounts_branch'         => 'required|string',
            'bank_accounts_routing_number' => 'required|string',
            'bank_accounts_country'        => 'required|string',
            'bank_accounts_state'          => 'required|string',
            'bank_accounts_city'           => 'required|string',
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
            'gas_cart_front',
            'gas_card_back',

            'nic_eic_number',
            'nic_eic_issue_date',
            'nic_eic_expire_date',
            'nic_eic_cart_front',
            'nic_eic_card_back',

            'driving_licence_number',
            'driving_licence_issue_date',
            'driving_licence_expire_date',
            'driving_licence_cart_front',
            'driving_licence_card_back',

            'label',
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
            'bank_accounts_branch',
            'bank_accounts_routing_number',
            'bank_accounts_country',
            'bank_accounts_state',
            'bank_accounts_city',
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
