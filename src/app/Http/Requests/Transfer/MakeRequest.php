<?php

namespace App\Http\Requests\Transfer;

use App\Services\TransferService;
use Illuminate\Foundation\Http\FormRequest;

class MakeRequest extends FormRequest
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
            'bankCode' => 'required|string|max:30',
            'accountNo' => 'required|string|min:3|max:22',
            'accountType' => 'required|string|in:' . implode(',', TransferService::ACCOUNT_TYPE),
            'accountName' => 'required|string|max:80',
            'amount' => 'required|integer|',
            'feeType' => 'required|string|in:' . implode(',', TransferService::FEE_TYPE),
            'partnerRefId' => 'required|string|max:50',
            'message' => 'nullable|string|regex:/^[a-zA-Z0-9]+$/i|max:255',
            'customerPhoneNumber' => 'nullable|string|min:10|max:15',
            'contractNumber' => 'nullable|string|max:30',
            'channel' => 'nullable|string',
            'bankId' => 'nullable|string',
        ];
    }
}
