<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStepThreeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isSeller() && auth()->user()->hasCompletedBusinessInfo();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // If skip is present, skip validation
        if ($this->has('skip')) {
            return [];
        }

        return [
            'bank_name' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'branch_location' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'bank_name.required' => 'Bank name is required.',
            'ifsc_code.required' => 'IFSC code is required.',
            'bank_account_number.required' => 'Bank account number is required.',
            'account_holder_name.required' => 'Account holder name is required.',
            'branch_location.required' => 'Branch location is required.',
        ];
    }
}
