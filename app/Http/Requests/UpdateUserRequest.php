<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'username' => [
                'required',
                'string',
                Rule::unique('users', 'username')->ignore($this->id)
            ],
            'password' => 'nullable',
            'id_karyawan' => [
                'required',
                Rule::unique('users', 'id_karyawan')->ignore($this->id),
                'exists:karyawan,id'
            ],
            'role' => 'required|in:admin,karyawan',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::debug('Validation failed',[$validator->getMessageBag()]);
        return response()->json(['error' => 'Failed to Data  Please try again.'],422);
    }
}
