<?php

namespace Database\Factories;

use App\Enums\ReferralStatus;
use App\Models\ReferralRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referral>
 */
class ReferralFactory extends Factory
{
    /** {@inheritDoc} */
    public function definition(): array
    {
        return [
            'referral_rule_id' => ReferralRule::inRandomOrder()->first(),
            'level' => 1,
        ];
    }

    /**
     * Indicate that the referral is pending
     *
     * @return \Database\Factories\ReferralFactory
     */
    public function pending(): ReferralFactory
    {
        return $this->state(fn(array $attributes) => [
            'status' => ReferralStatus::Pending,
        ]);
    }

    /**
     * Indicate that the referral is approved.
     *
     * @return \Database\Factories\ReferralFactory
     */
    public function approved(): ReferralFactory
    {
        return $this->state(fn(array $attributes) => [
            'status' => ReferralStatus::Approved,
        ]);
    }

    /**
     * Indicate that the referral is approved.
     *
     * @return \Database\Factories\ReferralFactory
     */
    public function rejected(): ReferralFactory
    {
        return $this->state(fn(array $attributes) => [
            'status' => ReferralStatus::Rejected,
        ]);
    }
}
