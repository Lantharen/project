<?php

namespace App\Orchid\Layouts\Offer;

use App\Models\Offer;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OfferListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'offers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     * @uses \App\Orchid\Screens\Offer\AbstractOfferScreen::deleteOffer()
     */
    protected function columns(): array
    {
        return [

            TD::make('name', __('Name'))
                ->cantHide(),

            TD::make('investments', __('Investments'))
                ->cantHide()
                ->render(fn(Offer $offer) => $offer->presenter()->investmentsLine()),

            TD::make('interest', __('Interest'))
                ->cantHide()
                ->render(fn(Offer $offer) => $offer->presenter()->interestsLine()),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Offer $offer) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.offers.edit', $offer->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Want to delete this Offer?'))
                            ->method('deleteOffer', [
                                'offer' => $offer->id,
                            ]),

                    ])),

        ];
    }
}
