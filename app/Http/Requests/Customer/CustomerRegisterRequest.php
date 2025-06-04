<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
            // User fields
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',

            // Customer fields
            'company_name' => 'required|string|max:255',
            'license_number' => 'required|string|max:100|unique:customers,license_number',
            'vat_number' => 'nullable|string|max:100|unique:vat_documents,vat_number',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_designation' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'plans' => 'nullable|in:free,basic,premium',
        ];
    }

    public function messages(): array
    {
        return [
            // User validation messages
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',

            // Customer validation messages
            'company_name.required' => 'Company name is required',
            'license_number.required' => 'License number is required',
            'license_number.unique' => 'This license number is already registered',
            'vat_number.unique' => 'This VAT number is already registered',
            'contact_person_name.required' => 'Contact person name is required',
            'contact_person_designation.required' => 'Contact person designation is required',
            'file_path.mimes' => 'File must be a PDF, JPG, JPEG or PNG',
            'file_path.max' => 'File size must not exceed 2MB',
            'plans.in' => 'Invalid plan selected',
        ];
    }
}
