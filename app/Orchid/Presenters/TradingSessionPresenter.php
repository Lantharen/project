<?php

namespace App\Orchid\Presenters;

use Orchid\Support\Presenter;

class TradingSessionPresenter extends Presenter
{
    /**
     * Returns a formatted string representing the investment of the trading-session.
     *
     * @return string
     */
    public function investmentLine(): string
    {
        if (!$this->entity->investment) {
            return '&mdash;';
        }

        return money_parse($this->entity->investment)->format();
    }

    /**
     * Get the trading session interests line.
     *
     * @return string
     */
    public function interestLine(): string
    {
        if (!$this->entity->interest) {
            return '&mdash;';
        }

        $interest = number_format($this->entity->interest, 2);

        return "$interest%";
    }
}
