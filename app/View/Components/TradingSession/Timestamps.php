<?php

namespace App\View\Components\TradingSession;

use App\Models\TradingSession;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Timestamps extends Component
{
    /**
     * The date when the trading session was created.
     *
     * @var \Carbon\Carbon
     */
    public Carbon $created;

    /**
     * The date when the trading session was started.
     *
     * @var \Carbon\Carbon|null
     */
    public ?Carbon $start = null;

    /**
     * The date when the trading session was ended.
     *
     * @var \Carbon\Carbon|null
     */
    public ?Carbon $end = null;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\TradingSession  $tradingSession
     * @return void
     */
    public function __construct(TradingSession $tradingSession)
    {
        $this->created = $tradingSession->created_at;
        $this->start = $tradingSession->start_at;
        $this->end = $tradingSession->end_at;
    }

    /**
     * Get the view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.trading-session.timestamps');
    }
}
