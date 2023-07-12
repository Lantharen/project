<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class SaveOfferRequest extends FormRequest
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
            'offer.name' => ['required', 'string', 'between:3,80'],
            'offer.min_investment' => ['required', 'numeric', 'min:0'],
            'offer.max_investment' => ['nullable', 'numeric', 'gt:offer.min_investment'],
            'offer.min_interest' => ['required', 'numeric', 'min:0'],
            'offer.max_interest' => ['nullable', 'numeric', 'gt:offer.min_interest'],
            'offer.duration_in_seconds' => ['required', 'integer', 'min:1'],
            'offer.position' => ['required', 'integer', 'min:0', 'max:10000'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $data = $this->input('offer');

        // Add data manually
        $data['duration_in_seconds'] = $this->input('offer.duration_in_hours') * 3600;

        // Remove unused data
        unset($data['duration_in_hours']);

        // Replace data in parameter bags
        $this->replace([
            'offer' => $data
        ]);
    }
}
