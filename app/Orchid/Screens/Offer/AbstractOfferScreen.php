<?php

namespace App\Orchid\Screens\Offer;

use App\Actions\DeleteOffer;
use App\Models\Offer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

abstract class AbstractOfferScreen extends Screen
{
    /**
     * Delete the given offer.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteOffer(Offer $offer): RedirectResponse
    {
        try {
            (new DeleteOffer($offer))->execute();
            Toast::warning(__('Offer was removed'));
        } catch (Exception $exception) {
            Toast::error(__($exception->getMessage()));
        }

        return redirect()->route('platform.systems.offers');
    }
}
