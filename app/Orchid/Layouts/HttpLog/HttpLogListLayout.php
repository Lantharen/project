<?php

namespace App\Orchid\Layouts\HttpLog;

use App\Models\HttpLog;
use App\View\Components\HttpLog\{RequestMethodComponent, StatusCodeComponent};
use Orchid\Screen\{Layouts\Table, TD};

class HttpLogListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'http_logs';

    /** {@inheritDoc} */
    protected function columns(): iterable
    {
        return [
            TD::make('user.name', __('User'))
                ->cantHide(),

            TD::make('ip', __('IP'))
                ->cantHide(),

            TD::make('method', __('Method'))
                ->asComponent(RequestMethodComponent::class),

            TD::make('path', __('Path'))
                ->cantHide(),

            TD::make('status_code', __('Status'))
                ->asComponent(StatusCodeComponent::class),

            TD::make('created_at', __('Date'))
                ->sort()
                ->cantHide()
                ->render(fn(HttpLog $httpLog) => $httpLog->created_at->toDateTimeString()),
        ];
    }

    /** {@inheritDoc} */
    protected function striped(): bool
    {
        return true;
    }
}
