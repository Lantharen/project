<?php

namespace App\Actions;

use App\Contracts\Actionable;
use App\Models\Offer;

class DeleteOffer implements Actionable
{
    /**
     * The offer whose deleting
     *
     * @var \App\Models\Offer
     */
    private readonly Offer $offer;

    /**
     * DeleteOffer constructor.
     *
     * @param  Offer  $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): void
    {
        $this->offer->delete();
    }
}
