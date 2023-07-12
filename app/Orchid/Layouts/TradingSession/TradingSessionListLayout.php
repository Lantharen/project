<?php

namespace App\Orchid\Layouts\TradingSession;

use App\Models\TradingSession;
use App\View\Components\TradingSession\Status;
use App\View\Components\TradingSession\Timestamps;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TradingSessionListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'trading_sessions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('user.name', 'User')
                ->cantHide(),

            TD::make('offer.name', 'Offer')
                ->cantHide(),

            TD::make('status', 'Status')
                ->asComponent(Status::class)
                ->cantHide(),

            TD::make('investment', 'Investment')
                ->render(fn(TradingSession $tradingSession) => $tradingSession->presenter()->investmentLine())
                ->cantHide(),

            TD::make('interest', 'Interest')
                ->render(fn(TradingSession $tradingSession) => $tradingSession->presenter()->interestLine())
                ->cantHide(),

            TD::make('timestamps', 'Session Info')
                ->component(Timestamps::class)
                ->cantHide(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (TradingSession $tradingSession) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Details'))
                            ->route('platform.systems.trading-sessions.details', $tradingSession->id)
                            ->icon('pencil'),
                    ])),
        ];
    }
}
