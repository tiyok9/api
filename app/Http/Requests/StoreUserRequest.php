<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'id_karyawan' => 'required|exists:karyawan,id',
            'role' => 'required|in:admin,karyawan',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::debug('Validation failed',[$validator->getMessageBag()]);
        return response()->json(['error' => 'Failed to Data  Please try again.'],422);
    }
}
