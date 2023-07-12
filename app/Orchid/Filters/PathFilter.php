<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class PathFilter extends Filter
{
    /** {@inheritDoc} */
    public function name(): string
    {
        return __('Path');
    }

    /** {@inheritDoc} */
    public function parameters(): ?array
    {
        return ['path'];
    }

    /** {@inheritDoc} */
    public function run(Builder $builder): Builder
    {
        $path = $this->request->get('path');

        return $builder->where('path', 'like', '%'.$path.'%');
    }

    /** {@inheritDoc} */
    public function display(): iterable
    {
        return [
            Input::make('path')
                ->title(__('Path'))
                ->placeholder(__('Example: /admin/permissions'))
                ->minlength(3)
                ->maxlength(255)
        ];
    }
}
