<?php

namespace Database\Factories;

use App\Enums\ReferralRuleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReferralRule>
 */
class ReferralRuleFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [
            'name' => Str::title($this->faker->words(3, true)),
            'interest' => $this->faker->numberBetween(5, 20),
        ];
    }

    /**
     * Indicate that the referral-rule is fixed.
     *
     * @return \Database\Factories\ReferralRuleFactory
     */
    public function fixed(): ReferralRuleFactory
    {
        return $this->state(fn(array $attributes) => [
            'type' => ReferralRuleType::Fixed,
        ]);
    }

    /**
     * Indicate that the referral-rule is percentage.
     *
     * @return \Database\Factories\ReferralRuleFactory
     */
    public function percentage(): ReferralRuleFactory
    {
        return $this->state(fn(array $attributes) => [
            'type' => ReferralRuleType::Percentage,
        ]);
    }
}
