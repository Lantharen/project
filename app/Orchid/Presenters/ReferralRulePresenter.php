<?php

namespace App\Orchid\Presenters;

use App\Enums\ReferralRuleType;
use Orchid\Support\Presenter;

class ReferralRulePresenter extends Presenter
{
    /**
     * Get the referral-rule interest line.
     *
     * @return string
     */
    public function interestLine(): string
    {
        if (ReferralRuleType::Fixed === $this->entity->type) {
            return money_parse($this->entity->interest)->format();
        } elseif (ReferralRuleType::Percentage === $this->entity->type) {
            return number_format($this->entity->interest, 2) . '%';
        }
        return $this->entity->interest;
    }
}
