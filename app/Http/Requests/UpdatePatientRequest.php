<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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

        $id = $this->route('id');
        return [
            'name' => 'sometimes|required',
            'mother_name' => 'sometimes|required',
            'birthdate' => 'sometimes|required|date',
            'cpf' => 'sometimes|required|unique:patients,id,' . $id,
            'cns' => 'sometimes|required|unique:patients,id,' . $id,
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
