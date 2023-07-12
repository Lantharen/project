<?php

namespace App\Actions;

use App\Contracts\Actionable;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\User;
use DomainException;

class ChangeUserBalance implements Actionable
{
    /**
     * The user whose balance will be changed.
     *
     * @var \App\Models\User
     */
    private readonly User $user;

    /**
     * The type of transaction.
     *
     * @var \App\Enums\TransactionType
     */
    private readonly TransactionType $transactionType;

    /**
     * The amount of money to be added or subtracted from the user's balance.
     *
     * @var float
     */
    private readonly float $amount;

    /**
     * Create a new action instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Enums\TransactionType  $transactionType
     * @param  float  $amount
     * @return void
     */
    public function __construct(User $user, TransactionType $transactionType, float $amount)
    {
        $this->user = $user;
        $this->transactionType = $transactionType;
        $this->amount = $amount;
    }

    /** {@inheritDoc} */
    public function execute(): void
    {
        // Change user balance depending on the transaction type
        if ($this->transactionType->isWithdrawal()) {
            if ($this->amount > $this->user->balance) {
                throw new DomainException('Not enough money on the user\'s balance.');
            }

            $this->user->balance -= $this->amount;
        } else {
            $this->user->balance += $this->amount;
        }

        // Save the user in the database
        $this->user->save();
    }
}
