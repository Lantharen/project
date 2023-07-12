<?php

namespace App\View\Components\Transaction;

use App\Enums\TransactionType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TypeComponent extends Component
{
    /**
     * The transaction type.
     *
     * @var TransactionType
     */
    public TransactionType $type;

    /**
     * Create a new component instance.
     *
     * @param  string  $type Transaction type
     *
     */
    public function __construct(string $type)
    {
        $this->type = TransactionType::from($type);
    }

    /**
     * Get the view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction.type');
    }

    /**
     * Returns a formatted string representing the transaction type.
     *
     * @return string
     */
    public function innerColorClass(): string
    {
        return match ($this->type) {
            TransactionType::Deposit => 'text-success',
            TransactionType::Investing => 'text-warning',
            TransactionType::Withdraw => 'text-warning',
            TransactionType::Profit => 'text-info',
            TransactionType::Bonus => 'text-info',
            TransactionType::Referral => 'text-info',
            TransactionType::Retention => 'text-danger',
        };
    }
}
