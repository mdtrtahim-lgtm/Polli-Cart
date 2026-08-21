<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isCustomer();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|regex:/^01[0-9]{9}$/',
            'division' => 'required|string',
            'district' => 'required|string',
            'upazila' => 'nullable|string',
            'area' => 'nullable|string',
            'address' => 'required|string',
            'postal_code' => 'nullable|string|max:10',
            'type' => 'required|in:home,office,other',
            'default' => 'boolean',
        ];
    }
}
