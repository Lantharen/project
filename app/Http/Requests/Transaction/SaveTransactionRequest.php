<?php

namespace App\Http\Requests\Transaction;

use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SaveTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'transaction.user_id' => ['required', 'integer', 'exists:users,id'],
            'transaction.type' => ['required', new Enum(TransactionType::class)],
            'transaction.amount' => ['required', 'numeric', 'gte:1'],
            'transaction.created_at' => ['required', 'date'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $data = $this->input('transaction');

        $data['user_id'] = $data['user'];
        $data['type'] = $data['type']['value'];

        unset($data['user']);

        $this->replace([
            'transaction' => $data
        ]);
    }
}
