<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class IpAddressFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('IP Address');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['ip'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        $ip = $this->request->get('ip');

        return $builder->where('ip', $ip);
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Input::make('ip')
                ->title(__('IP Address'))
                ->placeholder(__('Example: 123.234.0.1'))
                ->maxlength(15)
        ];
    }
}
