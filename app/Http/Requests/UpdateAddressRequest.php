<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'cep' => 'required|string|regex:/^\d{5}-\d{3}$/',
            'logradouro' => 'required|string',
            'complemento' => 'nullable|string',
            'bairro' => 'required|string',
            'localidade' => 'required|string',
            'uf' => 'required|string|size:2',
        ];
    }
}
