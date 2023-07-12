<?php

namespace App\Orchid\Screens\Transaction;

use App\Actions\DeleteOffer;
use App\Actions\DeleteTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

abstract class AbstractTransactionScreen extends Screen
{
    /**
     * Delete the given transaction.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTransaction(Transaction $transaction): RedirectResponse
    {
        try {
            (new DeleteTransaction($transaction))->execute();
            Toast::warning(__('Transaction was removed'));
        } catch (Exception $exception) {
            Toast::error(__($exception->getMessage()));
        }

        return redirect()->route('platform.systems.transactions');
    }
}
