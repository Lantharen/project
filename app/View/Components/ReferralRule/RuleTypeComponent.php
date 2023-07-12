<?php

namespace App\View\Components\ReferralRule;

use App\Enums\ReferralRuleType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RuleTypeComponent extends Component
{
    /**
     * The referral-rule type.
     *
     * @var ReferralRuleType
     */
    public ReferralRuleType $type;

    /**
     * Create a new component instance.
     *
     * @param  string  $type Referral-Rule type
     *
     */
    public function __construct(string $type)
    {
        $this->type = ReferralRuleType::from($type);
    }

    /**
     * Get the view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.referral-rule.rule-type');
    }

    /**
     * Returns a formatted string representing the referral-rule type.
     *
     * @return string
     */
    public function innerColorClass(): string
    {
        return match ($this->type) {
            ReferralRuleType::Fixed => 'text-success',
            ReferralRuleType::Percentage => 'text-primary',
        };
    }
}
