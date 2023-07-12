<?php

namespace App\Orchid\Presenters;

use Illuminate\Support\Str;
use Orchid\Support\Presenter;

class TransactionPresenter extends Presenter
{
    /**
     * Returns a formatted string representing the amount of the transaction.
     *
     * @return string
     */
    public function amountLine(): string
    {
        return money_parse($this->entity->amount)->format();
    }
}
