<?php

namespace App\Orchid\Screens\Referral;

use App\Models\Referral;
use App\Orchid\Layouts\Referral\ReferralFilterLayout;
use App\Orchid\Layouts\Referral\ReferralListLayout;
use Orchid\Screen\Actions\Link;

class ReferralListScreen extends AbstractReferralScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'referrals' => Referral::with('referralRule', 'referral', 'referrer')
                ->filters()
                ->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Referral List';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.referrals.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ReferralFilterLayout::class,
            ReferralListLayout::class,

        ];
    }
}
