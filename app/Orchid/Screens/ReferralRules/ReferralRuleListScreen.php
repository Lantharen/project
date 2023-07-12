<?php

namespace App\Orchid\Screens\ReferralRules;

use App\Models\ReferralRule;
use App\Orchid\Layouts\ReferralRule\ReferralRuleFilterLayout;
use App\Orchid\Layouts\ReferralRule\ReferralRuleListLayout;
use Orchid\Screen\Screen;

class ReferralRuleListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return iterable
     */
    public function query(): iterable
    {
        return [
            'referral_rules' => ReferralRule::filters()->paginate()
        ];

    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Referral Rule';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ReferralRuleFilterLayout::class,
            ReferralRuleListLayout::class,
        ];
    }
}
