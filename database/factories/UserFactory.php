<?php

namespace Database\Factories;

use App\Enums\TradingSessionStatus;
use App\Models\Offer;
use App\Models\TradingSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'balance' => 0.00,
        ];
    }

    /**
     * Indicate that the model's email address should be verified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
     */
    public function verified(): Factory
    {
        return $this->state(fn() => [
            'email_verified_at' => now()
        ]);
    }

    /** {@inheritDoc} */
    public function configure(): Factory
    {
        return $this->afterCreating(function (User $user) {
            $this->createTradingSessionForUser($user);
        });
    }

    /**
     * Create a set of trading session with any available status.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    private function createTradingSessionForUser(User $user): void
    {
        $offers = Offer::all();

        foreach (TradingSessionStatus::cases() as $status) {
            $offer = $offers->random();

            $attributes = [
                'status' => $status
            ];

            // Investments and interests are set only for pending, active and closed sessions
            if (TradingSessionStatus::Pending === $status ||
                TradingSessionStatus::Active === $status ||
                TradingSessionStatus::Closed === $status) {
                $attributes['investment'] = $offer->min_investment;
                $attributes['interest'] = $offer->min_interest;
            }

            $attributes['start_at'] = match ($status) {
                // Pending: Defer the trading session to the near future
                TradingSessionStatus::Pending => $this->faker->dateTimeBetween('+1 day', '+7 days'),
                // Active: The trading session is halfway through at the moment
                TradingSessionStatus::Active => now()->subRealSeconds($offer->duration_in_seconds / 2),
                // Closed: 0 or more seconds have passed after the end of the trading session
                TradingSessionStatus::Closed => $this->faker->dateTimeBetween(
                    sprintf('-%d seconds', $offer->duration_in_seconds * 100),
                    sprintf('-%d seconds', $offer->duration_in_seconds)
                ),
                // In all other cases the start date is not set
                default => null
            };

            if (isset($attributes['start_at'])) {
                $startAt = $attributes['start_at'];

                // If there is a start date, we need to compute the end date by adding the duration
                // of the trading session in seconds to the start date
                $attributes['end_at'] = Carbon::parse($startAt)->addRealSeconds($offer->duration_in_seconds);

                // Set the date of creation a trading session a little earlier than the start date
                $attributes['created_at'] = Carbon::parse($startAt)->subRealHours(4);

                // Set the date up updating a trading session the same as the end date
                $attributes['updated_at'] = $attributes['end_at']->clone();
            }

            // Complete created and updated dates
            if (!isset($attributes['created_at'])) {
                $createdUpdatedAt = $this->faker->dateTimeBetween('-1 day');

                $attributes['created_at'] = $createdUpdatedAt;
                $attributes['updated_at'] = $createdUpdatedAt;
            }

            TradingSession::factory()
                ->for($user)
                ->for($offer)
                ->create($attributes);
        }
    }
}
