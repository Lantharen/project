<?php

namespace App\Orchid\Filters;

use App\Enums\ReferralRuleType;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class ReferralRuleTypeFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Referral Rule Type');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['type'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        $type = $this->request->get('type');

        return $builder->where('type', $type);
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Select::make('type')
                ->title(__('Referral-Rule Type'))
                ->options(ReferralRuleType::forDropdown())
                ->empty(__('Choose...')),
        ];
    }
}
