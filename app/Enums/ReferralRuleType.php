<?php

namespace App\Enums;

enum ReferralRuleType: string
{
    case Fixed = 'FIXED';
    case Percentage = 'PERCENTAGE';

    /**
     * Get all the values for using in the dropdowns.
     *
     * @return array<string, string>
     */
    public static function forDropdown(): array
    {
        $items = [];

        foreach (self::cases() as $item) {
            $items[$item->value] = __($item->name);
        }

        return $items;
    }

    /**
     * Get the name of the referral rule status.
     *
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            ReferralRuleType::Fixed => __('Fixed'),
            ReferralRuleType::Percentage => __('Percentage'),
        };
    }
}
