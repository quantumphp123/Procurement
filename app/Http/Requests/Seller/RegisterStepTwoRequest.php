<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStepTwoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isSeller();
    }

    public function rules(): array
    {
        // If skip is present, skip validation
        if ($this->has('skip')) {
            return [];
        }

        return [
            'trade_license_number' => 'required|string|max:255',
            'vat' => 'required|string|max:255',
            'product_category' => 'required|exists:categories,id',
            'contact_person' => 'required|string|max:255',
            'office_address' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'product_category.exists' => 'Please select a valid product category.',
        ];
    }
}
