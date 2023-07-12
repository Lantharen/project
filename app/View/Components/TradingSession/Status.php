<?php

namespace App\View\Components\TradingSession;

use App\Enums\TradingSessionStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Status extends Component
{
    /**
     * The status of the trading session.
     *
     * @var \App\Enums\TradingSessionStatus
     */
    public TradingSessionStatus $status;

    /**
     * Create a new component instance.
     *
     * @param  string  $status
     * @return void
     */
    public function __construct(string $status)
    {
        $this->status = TradingSessionStatus::from($status);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.trading-session..status');
    }

    public function iconColorClass(): string
    {
        return match ($this->status) {
            TradingSessionStatus::New => 'text-primary',
            TradingSessionStatus::Pending => 'text-warning',
            TradingSessionStatus::Active => 'text-success',
            TradingSessionStatus::Closed => 'text-dark',
            TradingSessionStatus::Rejected => 'text-danger',
        };
    }
}
