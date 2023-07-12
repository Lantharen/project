<?php

namespace App\Orchid\Layouts\Referral;

use App\Models\Referral;
use App\View\Components\Referral\ReferralStatusComponent;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReferralListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'referrals';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     *
     * @uses \App\Orchid\Screens\Referral\AbstractReferralScreen::deleteReferral()
     */
    protected function columns(): iterable
    {
        return [
            TD::make('referralRule.name', 'Referral Rule')
                ->cantHide(),

            TD::make('referrer.name', 'Referrer')
                ->cantHide(),

            TD::make('referral.name', 'Referral')
                ->cantHide(),

            TD::make('status', 'Status')
                ->asComponent(ReferralStatusComponent::class)
                ->cantHide(),

            TD::make('created_at', 'Created At')
                ->cantHide()
                ->render(fn(Referral $referral) => $referral->created_at->toDateTimeString()),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Referral $referral) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.referrals.edit', $referral->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Want to delete this Referral?'))
                            ->method('deleteReferral', [
                                'referral' => $referral->id,
                            ]),

                    ])),
        ];
    }
}
