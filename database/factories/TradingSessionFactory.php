<?php

namespace Database\Factories;

use App\Enums\TradingSessionStatus;
use App\Models\TradingSession;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TradingSession>
 */
class TradingSessionFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [];
    }

    /** {@inheritDoc} */
    public function configure(): Factory
    {
        return $this->afterCreating(function (TradingSession $tradingSession) {
            if (TradingSessionStatus::Pending === $tradingSession->status ||
                TradingSessionStatus::Active === $tradingSession->status ||
                TradingSessionStatus::Closed === $tradingSession->status) {
                // To book a trading session, you need to deposit the user's balance,
                // so you need to create a corresponding transaction
                Transaction::factory()
                    ->deposit()
                    ->for($tradingSession->user)
                    ->create([
                        'amount' => $tradingSession->investment,
                        'created_at' => $tradingSession->start_at->subRealHour(),
                        'updated_at' => $tradingSession->start_at->subRealHour(),
                    ]);

                // Once the balance has been replenished, it will be invested
                // in the trading session
                Transaction::factory()
                    ->investing()
                    ->for($tradingSession->user)
                    ->create([
                        'amount' => $tradingSession->investment,
                        'created_at' => $tradingSession->start_at->subRealMinutes(30),
                        'updated_at' => $tradingSession->start_at->subRealMinutes(30),
                    ]);
            }

            if (TradingSessionStatus::Closed === $tradingSession->status) {
                // After the end of the trading session it is necessary to create a
                // transaction with the accrual of profit + body of the deposit
                $profit = $tradingSession->investment + ($tradingSession->investment * $tradingSession->interest * 0.01);

                Transaction::factory()
                    ->profit()
                    ->for($tradingSession->user)
                    ->create([
                        'amount' => $profit,
                        'created_at' => $tradingSession->end_at,
                        'updated_at' => $tradingSession->end_at,
                    ]);

                // Then we will withdraw half of the amount from the user's balance
                Transaction::factory()
                    ->withdraw()
                    ->for($tradingSession->user)
                    ->create([
                        'amount' => $profit * 0.5,
                        'created_at' => $tradingSession->end_at->addRealHour(),
                        'updated_at' => $tradingSession->end_at->addRealHour(),
                    ]);
            }
        });
    }
}
