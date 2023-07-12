<?php

namespace App\Orchid\Filters;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class RelationalReferrerFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Referrer');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['referrer_id'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        return $builder->where('referrer_id', $this->request->get('referrer_id'));
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        $referrerIds = Referral::distinct()->pluck('referrer_id');

        $referrers = User::whereIn('id', $referrerIds)
            ->orderBy('name')
            ->pluck('name', 'id');

        return [
            Select::make('referrer_id')
                ->title(__('Referrer'))
                ->options($referrers)
                ->empty('Choose..')
        ];
    }
}
