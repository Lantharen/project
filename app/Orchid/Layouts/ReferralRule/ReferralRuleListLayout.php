<?php

namespace App\Orchid\Layouts\ReferralRule;

use App\Models\ReferralRule;
use App\View\Components\ReferralRule\RuleTypeComponent;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReferralRuleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'referral_rules';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Name')
            ->cantHide(),

            TD::make('type', 'Type')
                ->asComponent(RuleTypeComponent::class)
                ->cantHide(),

            TD::make('interest', 'Interest')
                ->render(fn(ReferralRule $referralRule) => $referralRule->presenter()->interestLine())
            ->cantHide(),

        ];
    }
}
