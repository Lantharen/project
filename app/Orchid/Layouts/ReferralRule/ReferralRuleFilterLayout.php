<?php

namespace App\Orchid\Layouts\ReferralRule;

use App\Orchid\Filters\ReferralRuleTypeFilter;
use Orchid\Screen\Layouts\Selection;

class ReferralRuleFilterLayout extends Selection
{
    /** {@inheritDoc} */
    public function filters(): iterable
    {
        return [
            ReferralRuleTypeFilter::class,
        ];
    }
}
