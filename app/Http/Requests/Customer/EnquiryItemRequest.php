<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryItemRequest extends FormRequest
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
            'enquiry_id' => 'required|exists:enquiries,id',
            'items' => 'required|array|min:1',
            'items.*.category_id' => 'required|exists:categories,id',
            'items.*.item_description' => 'required|string|max:1000',
            'items.*.manufacturer' => 'required|string|max:255',
            'items.*.qty' => 'required|integer|min:1|max:999999',
            'items.*.remark' => 'nullable|string|max:500',
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
            'enquiry_id.required' => 'The enquiry ID is required.',
            'enquiry_id.exists' => 'The selected enquiry is invalid.',
            'items.required' => 'At least one item is required.',
            'items.array' => 'The items must be in a valid format.',
            'items.min' => 'At least one item is required.',
            'items.*.category_id.required' => 'Please select an item category.',
            'items.*.category_id.exists' => 'The selected item category is invalid.',
            'items.*.item_description.required' => 'Item description is required.',
            'items.*.item_description.max' => 'Item description cannot exceed 1000 characters.',
            'items.*.manufacturer.required' => 'Manufacturer name is required.',
            'items.*.manufacturer.max' => 'Manufacturer name cannot exceed 255 characters.',
            'items.*.qty.required' => 'Quantity is required.',
            'items.*.qty.integer' => 'Quantity must be a whole number.',
            'items.*.qty.min' => 'Quantity must be at least 1.',
            'items.*.qty.max' => 'Quantity cannot exceed 999,999.',
            'items.*.remark.max' => 'Remarks cannot exceed 500 characters.',
        ];
    }
}