<?php

namespace App\Orchid\Filters;

use App\Enums\ReferralStatus;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class ReferralStatusFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Referral Status');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['status'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        $status = $this->request->get('status');

        return $builder->where('status', $status);
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Select::make('status')
                ->title(__('Referral Status'))
                ->options(ReferralStatus::forDropdown())
                ->empty(__('Choose...')),
        ];
    }
}
