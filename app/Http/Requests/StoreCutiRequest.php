<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreCutiRequest extends FormRequest
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
            'id_jenis_cuti' => 'required|exists:jenis_cuti,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'alasan' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::debug('Validation failed',[$validator->getMessageBag()]);
        return response()->json(['error' => 'Failed to Data  Please try again.'],422);
    }
}
