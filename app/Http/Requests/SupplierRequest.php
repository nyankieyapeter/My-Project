<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_name' => 'required|string|max:20',
            'supplier_company' => 'required|string|max:25',
            'supplier_telephone' => 'required|string|max:13',
            'supplier_email' => ['required', 'email', Rule::unique('suppliers', 'email')->ignore($this->supplier)],
        ];
    }
}
