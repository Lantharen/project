<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class RelationalUserNameFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('User name');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['name'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('user', function (Builder $query): void {
            $name = $this->request->get('name');

            $query->where('name', 'like', '%'.$name.'%');
        });
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Input::make('name')
                ->title(__('User name'))
                ->placeholder(__('Example: John Doe'))
                ->minlength(3)
                ->maxlength(255)
        ];
    }
}
