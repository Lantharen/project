<?php

namespace App\Orchid\Filters;

use App\Enums\ReferralStatus;
use App\Models\ReferralRule;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class RelationalReferralRuleFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Referral Rule');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['referral_rule_id'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('referralRule', function (Builder $query) {
            $query->where('id', '=', $this->request->get('referral_rule_id'));
        });
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Select::make('referral_rule_id')
                ->title(__('Referral Rule'))
                ->options(ReferralRule::pluck('name', 'id'))
                ->empty('Choose..'),
        ];
    }
}
