<?php

namespace App\Enums;

enum ReferralStatus: string
{
    case Pending = 'PENDING';
    case Approved = 'APPROVED';
    case Rejected = 'REJECTED';

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
     * Get the name of the referral status.
     *
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            ReferralStatus::Pending => __('Pending'),
            ReferralStatus::Approved => __('Approved'),
            ReferralStatus::Rejected => __('Rejected'),
        };
    }
}
