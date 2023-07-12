<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [
            'status' => TransactionStatus::Approved, // By default for some times...
        ];
    }

    /**
     * Indicate that the transaction's status should be deposited.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function deposit(): Factory
    {
        return $this->state(fn() => [
            'type' => TransactionType::Deposit,
        ]);
    }

    /**
     * Indicate that the transaction's status should be investing.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function investing(): Factory
    {
        return $this->state(fn() => [
            'type' => TransactionType::Investing,
        ]);
    }

    /**
     * Indicate that the transaction's status should be withdrawal.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function withdraw(): Factory
    {
        return $this->state(fn() => [
            'type' => TransactionType::Withdraw,
        ]);
    }

    /**
     * Indicate that the transaction's status should be profit.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    public function profit(): Factory
    {
        return $this->state(fn() => [
            'type' => TransactionType::Profit,
        ]);
    }

    /** {@inheritDoc} */
    public function configure(): Factory
    {
        return $this->afterCreating(function (Transaction $transaction) {
            if ($transaction->type->isWithdrawal()) {
                User::where('id', '=', $transaction->user_id)->update([
                    'balance' => DB::raw('balance - '.$transaction->amount)
                ]);
            } else {
                User::where('id', '=', $transaction->user_id)->update([
                    'balance' => DB::raw('balance + '.$transaction->amount)
                ]);
            }
        });
    }
}
