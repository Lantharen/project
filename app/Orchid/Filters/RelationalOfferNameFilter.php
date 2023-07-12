<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class RelationalOfferNameFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Offer name');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['offer'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('offer', function (Builder $query): void {
            $offer = $this->request->get('offer');

            $query->where('name', 'like', '%'.$offer.'%');
        });
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Input::make('offer')
                ->title(__('Offer name'))
                ->placeholder(__('Example: Odit Eos Qui'))
                ->minlength(3)
                ->maxlength(255)
        ];
    }
}
