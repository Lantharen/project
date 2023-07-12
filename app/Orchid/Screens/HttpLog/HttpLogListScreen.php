<?php

namespace App\Orchid\Screens\HttpLog;

use App\Models\HttpLog;
use App\Orchid\Layouts\HttpLog\{HttpLogFilterLayout, HttpLogListLayout};
use Orchid\Screen\Screen;

class HttpLogListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'http_logs' => HttpLog::with('user:id,name')
                ->filters()
                ->defaultSort('created_at', 'desc')
                ->paginate(),
        ];
    }

    /** {@inheritDoc} */
    public function name(): ?string
    {
        return 'HTTP Logs';
    }

    /** {@inheritDoc} */
    public function description(): ?string
    {
        return 'A comprehensive list of all HTTP requests made to the application.';
    }

    /** {@inheritDoc} */
    public function commandBar(): iterable
    {
        return [];
    }

    /** {@inheritDoc} */
    public function layout(): iterable
    {
        return [
            HttpLogFilterLayout::class,
            HttpLogListLayout::class,
        ];
    }
}
