<?php

namespace App\Enums;

enum TransactionType: string
{
    case Deposit = 'DEPOSIT';
    case Investing = 'INVESTING';
    case Withdraw = 'WITHDRAW';
    case Profit = 'PROFIT';
    case Bonus = 'BONUS';
    case Referral = 'REFERRAL';
    case Retention = 'RETENTION';

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
     * Determines whether the current transaction type is a withdrawal transaction.
     *
     * @return bool
     */
    public function isWithdrawal(): bool
    {
        return in_array($this, [
            TransactionType::Investing,
            TransactionType::Withdraw,
            TransactionType::Retention,
        ], true);
    }

    /**
     * Returns a formatted string representing the transaction type.
     *
     * @return string
     */
    public function name(): string
    {
        return match ($this) {
            TransactionType::Deposit => __('Deposit'),
            TransactionType::Investing => __('Investing'),
            TransactionType::Withdraw => __('Withdraw'),
            TransactionType::Profit => __('Profit'),
            TransactionType::Bonus => __('Bonus'),
            TransactionType::Referral => __('Referral'),
            TransactionType::Retention => __('Retention'),
        };
    }
}
