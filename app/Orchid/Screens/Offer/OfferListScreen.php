<?php

namespace App\Orchid\Screens\Offer;

use App\Models\Offer;
use App\Orchid\Layouts\Offer\OfferListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;

class OfferListScreen extends AbstractOfferScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'offers' => Offer::with('attributes')->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Offers';
    }

    /** {@inheritDoc} */
    public function description(): ?string
    {
        return 'A comprehensive list of all offers available';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.offers.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            OfferListLayout::class
        ];
    }
}
