<?php

namespace App\Orchid\Layouts\TradingSession;

use App\Orchid\Filters\{RelationalOfferNameFilter, RelationalUserNameFilter, TradingSessionStatusFilter};
use Orchid\Screen\Layouts\Selection;

class TradingSessionFilterLayout extends Selection
{
    /** {@inheritDoc} */
    public function filters(): iterable
    {
        return [
            RelationalUserNameFilter::class,
            RelationalOfferNameFilter::class,
            TradingSessionStatusFilter::class,
        ];
    }
}
