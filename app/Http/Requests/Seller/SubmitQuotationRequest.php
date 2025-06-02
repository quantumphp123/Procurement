<?php
namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuotationRequest extends FormRequest
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
        return [
            'items' => 'required|array|min:1',
            'items.*.enquiry_item_id' => 'required|exists:enquiry_items,id',
            'items.*.unit_price' => 'required|numeric|min:0.01',
            'items.*.quantity' => 'required|integer|min:1',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'At least one item is required.',
            'items.*.unit_price.required' => 'Unit price is required for all items.',
            'items.*.unit_price.min' => 'Unit price must be greater than 0.',
            'items.*.enquiry_item_id.exists' => 'Invalid enquiry item.',
        ];
    }
}
