<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'mother_name' => 'required',
            'birthdate' => 'required|date',
            'cpf' => 'required|unique:patients|cpf',
            'cns' => 'required|unique:patients',
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
