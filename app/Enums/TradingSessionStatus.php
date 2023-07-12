<?php

namespace App\Enums;

enum TradingSessionStatus: string
{
    case New = 'NEW';
    case Pending = 'PENDING';
    case Active = 'ACTIVE';
    case Closed = 'CLOSED';
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
     * Get the name of the trading session status.
     *
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            TradingSessionStatus::New => __('New'),
            TradingSessionStatus::Pending => __('Pending'),
            TradingSessionStatus::Active => __('Active'),
            TradingSessionStatus::Closed => __('Closed'),
            TradingSessionStatus::Rejected => __('Rejected'),
        };
    }
}
