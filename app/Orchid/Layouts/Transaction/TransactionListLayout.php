<?php

namespace App\Orchid\Layouts\Transaction;

use App\Models\Transaction;
use App\View\Components\Transaction\TypeComponent;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TransactionListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'transactions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     *
     * @uses \App\Orchid\Screens\Transaction\AbstractTransactionScreen::deleteTransaction()
     */
    protected function columns(): iterable
    {
        return [
            TD::make('user.name', 'User')
                ->cantHide(),

            TD::make('type')
                ->render(fn(Transaction $transaction) => $transaction->type->name())
                ->asComponent(TypeComponent::class)
                ->cantHide(),

            TD::make('amount', 'Amount')
                ->render(fn(Transaction $transaction) => $transaction->presenter()->amountLine())
                ->cantHide(),

            TD::make('created_at', 'Created At')
                ->sort()
                ->cantHide()
                ->render(fn(Transaction $transaction) => $transaction->created_at->toDateTimeString()),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Transaction $transaction) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.transactions.edit', $transaction->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Want to delete this Transaction?'))
                            ->method('deleteTransaction', [
                                'transaction' => $transaction->id,
                            ]),

                    ])),
        ];
    }
}
