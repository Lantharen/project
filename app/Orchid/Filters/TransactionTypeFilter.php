<?php

namespace App\Orchid\Filters;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class TransactionTypeFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Transaction Type');
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
                ->title(__('Transaction Type'))
                ->options(TransactionType::forDropdown())
                ->empty(__('Choose...')),
        ];
    }
}
