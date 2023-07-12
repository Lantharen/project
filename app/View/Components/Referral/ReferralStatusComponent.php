<?php

namespace App\View\Components\Referral;

use App\Enums\ReferralStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class ReferralStatusComponent extends Component
{
    /**
     * The referral status.
     *
     * @var \App\Enums\ReferralStatus
     */
    public ReferralStatus $status;

    /**
     * Create a new component instance.
     *
     * @param  string  $status Referral status
     *
     */
    public function __construct(string $status)
    {
        $this->status = ReferralStatus::from($status);
    }

    /**
     * Get the view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.referral.status');
    }

    /**
     * Returns a formatted string representing the referral-rule type.
     *
     * @return string
     */
    public function innerColorClass(): string
    {
        return match ($this->status) {
            ReferralStatus::Pending => 'text-success',
            ReferralStatus::Approved => 'text-primary',
            ReferralStatus::Rejected => 'text-danger',
        };
    }
}
