<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Since we're already in the customer middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();

        return [
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_designation' => 'required|string|max:255',
            'profile_pic' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
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
            'company_name.required' => 'Company name is required',
            'company_name.max' => 'Company name cannot exceed 255 characters',
            'phone.required' => 'Phone number is required',
            'phone.max' => 'Phone number cannot exceed 50 characters',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email address is already in use',
            'address.required' => 'Address is required',
            'contact_person_name.required' => 'Contact person name is required',
            'contact_person_name.max' => 'Contact person name cannot exceed 255 characters',
            'contact_person_designation.required' => 'Contact person designation is required',
            'contact_person_designation.max' => 'Contact person designation cannot exceed 255 characters',
            'profile_pic.mimes' => 'Profile picture must be a jpg, jpeg, or png file',
            'profile_pic.max' => 'Profile picture size cannot exceed 2MB'
        ];
    }
}
