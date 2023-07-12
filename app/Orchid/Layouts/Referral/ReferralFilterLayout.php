<?php

namespace App\Orchid\Layouts\Referral;

use App\Orchid\Filters\ReferralStatusFilter;
use App\Orchid\Filters\RelationalReferralRuleFilter;
use App\Orchid\Filters\RelationalReferrerFilter;
use Orchid\Screen\Layouts\Selection;

class ReferralFilterLayout extends Selection
{
    /** {@inheritDoc} */
    public function filters(): iterable
    {
        return [
            RelationalReferralRuleFilter::class,
            ReferralStatusFilter::class,
            RelationalReferrerFilter::class,
        ];
    }
}
