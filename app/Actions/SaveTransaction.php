<?php

namespace App\Actions;

use App\Contracts\Actionable;
use App\Models\Transaction;

class SaveTransaction implements Actionable
{
    /**
     * The transaction whose create or update.
     *
     * @var Transaction $transaction
     */
    private readonly Transaction $transaction;

    /**
     * Create a new action instance.
     *
     * @param Transaction $transaction
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
        $this->transaction->save();
    }
}
