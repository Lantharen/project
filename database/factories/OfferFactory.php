<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [
            'name' => Str::title($this->faker->words(3, true)),
            'min_investment' => $this->faker->numberBetween(100, 4999),
            'max_investment' => $this->faker->numberBetween(5000, 9999),
            'min_interest' => $this->faker->numberBetween(1, 5),
            'max_interest' => $this->faker->numberBetween(5, 45),
            'duration_in_seconds' => $this->faker->randomElement([
                86400,  // 1 day
                172800, // 2 days
                259200, // 3 days
                345600, // 4 days
                432000, // 5 days
                518400, // 6 days
                604800, // 7 days
            ]),
            'position' => $this->faker->unique()->numberBetween(0, 1000),
        ];
    }

    /**
     * Indicate that the offer has a fixed investment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
     */
    public function fixedInvestment(): Factory
    {
        return $this->state(fn() => ['max_investment' => null]);
    }

    /**
     * Indicate that the offer has a fixed interest.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
     */
    public function fixedInterest(): Factory
    {
        return $this->state(fn() => ['max_interest' => null]);
    }
}
