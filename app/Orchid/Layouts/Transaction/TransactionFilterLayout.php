<?php

namespace App\Orchid\Layouts\Transaction;

use App\Orchid\Filters\RelationalUserNameFilter;
use App\Orchid\Filters\TransactionTypeFilter;
use Orchid\Screen\Layouts\Selection;

class TransactionFilterLayout extends Selection
{
    /** {@inheritDoc} */
    public function filters(): iterable
    {
        return [
            RelationalUserNameFilter::class,
            TransactionTypeFilter::class,
        ];
    }
}
