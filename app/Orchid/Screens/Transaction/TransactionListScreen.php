<?php

namespace App\Orchid\Screens\Transaction;

use App\Models\Transaction;
use App\Orchid\Layouts\Transaction\TransactionFilterLayout;
use App\Orchid\Layouts\Transaction\TransactionListLayout;
use Orchid\Screen\Actions\Link;

class TransactionListScreen extends AbstractTransactionScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'transactions' => Transaction::with('user')
                ->filters()
                ->defaultSort('created_at', 'desc')
                ->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Transactions';
    }

    /**
     * @inheritDoc
     * @return string|null
     */
    public function description(): ?string
    {
       return 'A comprehensive list of all transactions made by users or the system.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.transactions.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            TransactionFilterLayout::class,
            TransactionListLayout::class,
        ];
    }
}
