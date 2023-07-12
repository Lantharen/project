<?php

namespace App\Orchid\Screens\TradingSession;

use App\Models\TradingSession;
use App\View\Components\TradingSession\Status;
use App\View\Components\TradingSession\Timestamps;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class TradingSessionDetailsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @param  TradingSession  $tradingSession
     * @return iterable
     */
    public function query(TradingSession $tradingSession): iterable
    {
        $tradingSession->load([
            'user' => fn(BelongsTo $builder) => $builder->withTrashed(),
            'offer' => fn(BelongsTo $builder) => $builder->withTrashed(),
        ]);

        return [
            'tradingSession' => $tradingSession,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Details Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return iterable
     * @throws \ReflectionException
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('tradingSession', [

                Sight::make('id', 'Id'),

                Sight::make('user.name', 'User'),

                Sight::make('offer.name', 'Offer'),

                Sight::make('status', 'Status')
                    ->asComponent(Status::class),

                Sight::make('investment', 'Investment')
                    ->render(fn(TradingSession $tradingSession) => $tradingSession->presenter()->investmentLine()),

                Sight::make('interest', 'Interest')
                    ->render(fn(TradingSession $tradingSession) => $tradingSession->presenter()->interestLine()),

                Sight::make('tradingSession.timestamps', 'Session Info')
                    ->component(Timestamps::class),
            ]),
        ];
    }
}
