<?php

namespace App\Http\Requests\Seller;

use App\Rules\CheckUniquePhone;
use Illuminate\Foundation\Http\FormRequest;

class RegisterStepOneRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => [
                'required',
                'string',
                'regex:/^[0-9]{10,15}$/',
                new CheckUniquePhone()
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {

        return [
            'full_name.required' => 'Full Name is required',
            'full_name.max' => 'Full Name cannot exceed 255 characters',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email cannot exceed 255 characters',
            'email.unique' => 'This email is already registered. Please use another email or login.',
            'phone_number.required' => 'Mobile number is required',
            'phone_number.unique' => 'This mobile number is already registered. Please use another number or login.',
            'phone_number.regex' => 'Please enter a valid phone number with only digits.',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',

        ];
    }
}
