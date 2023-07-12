<?php

namespace App\Actions;

namespace App\Actions;

use App\Contracts\Actionable;
use App\Models\Transaction;

class DeleteTransaction implements Actionable
{
    /**
     * The transaction whose deleting
     *
     * @var \App\Models\Transaction
     */
    private readonly Transaction $transaction;

    /**
     * DeleteTransaction constructor.
     *
     * @param  \App\Models\Transaction  $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $this->transaction->delete();
    }
}
