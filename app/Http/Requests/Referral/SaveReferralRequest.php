<?php

namespace App\Http\Requests\Referral;

use App\Models\Referral;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveReferralRequest extends FormRequest
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
        $requestedReferral = $this->route('referral');

        return [
            'referral.referral_rule_id' => [
                'required',
                'integer',
                'exists:referral_rules,id'
            ],
            'referral.referrer_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'referral.referral_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique(Referral::class, 'id')->ignore($requestedReferral, 'referral_id')
            ],
            'referral.created_at' => [
                'required',
                'date'
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $data = $this->input('referral');

        if (isset($data['referral_rule'])) {
            $data['referral_rule_id'] = $data['referral_rule'];

            unset($data['referral_rule']);
        }

        if (isset($data['status']['value'])) {
            $data['status'] = $data['status']['value'];
        }

        $this->replace([
            'referral' => $data
        ]);
    }
}
